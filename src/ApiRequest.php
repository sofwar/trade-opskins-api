<?php

namespace SofWar\Opskins;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use SofWar\Opskins\Exceptions\OpskinsApiException;

class ApiRequest
{
    protected const VERSION = 'v1';
    protected const CONNECTION_TIMEOUT = 5;
    protected const HTTP_STATUS_CODE_OK = 200;

    private const KEY_STATUS_CODE = 'status';
    private const KEY_RESPONSE = 'response';

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $version;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string|null
     */
    private $access_token;

    /**
     * ApiRequest constructor.
     *
     * @param string $host
     * @param string $version
     * @param string|null $access_token
     */
    public function __construct(string $host, ?string $version = self::VERSION, ?string $access_token = null)
    {
        $this->host = $host;
        $this->version = $version;
        $this->access_token = $access_token;

        $this->client = new Client([
            'base_uri' => $host,
            'timeout' => self::CONNECTION_TIMEOUT,
            'http_errors' => false,
        ]);
    }

    /**
     * Get call api.
     *
     * @param string $method
     * @param array $params
     * @param array $options
     * @param string $access_token
     *
     * @throws OpskinsApiException
     *
     * @return mixed
     */
    public function get(string $method, array $params = [], array $options = [], ?string $access_token = null)
    {
        if ($this->version !== null) {
            $method .= '/' . $this->version;
        }

        $options = $this->configOptions('GET', $params, $access_token, $options);

        $response = $this->client->get($method, $options);

        return $this->parseResponse($response);
    }

    /**
     * @param string $method
     * @param array $params
     * @param array $options
     * @param string $access_token
     *
     * @throws OpskinsApiException
     *
     * @return mixed
     */
    public function post(string $method, array $params = [], array $options = [], string $access_token = null)
    {
        if ($this->version !== null) {
            $method .= '/' . $this->version;
        }

        $options = $this->configOptions('POST', $params, $access_token, $options);

        $response = $this->client->post($method, $options);

        return $this->parseResponse($response);
    }

    /**
     * @param string|null $access_token
     */
    public function setAccessToken(?string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * Decodes the response and checks its status code and whether it has an Api error. Returns decoded response.
     *
     * @param ResponseInterface $response
     * @param bool $onlyResponse
     *
     * @throws OpskinsApiException
     *
     * @return mixed
     */
    private function parseResponse(ResponseInterface $response, bool $onlyResponse = true)
    {
        $body = $response->getBody()->getContents();

        $decode_body = $this->decodeBody($body);

        $code = $decode_body[static::KEY_STATUS_CODE] ?? 0;

        if ($code !== 1) {
            $error = null;

            if (isset($decode_body['error_description'])) {
                $error = $decode_body['error_description'];
            } elseif (isset($decode_body['message'])) {
                $error = $decode_body['message'];
            }

            throw new OpskinsApiException($error, $code);
        }

        if ($onlyResponse && isset($decode_body[static::KEY_RESPONSE])) {
            if (isset($decode_body['current_page'])) {
                $decode_body[static::KEY_RESPONSE]['metadata'] = [
                    'total' => $decode_body['total_pages'] ?? 1,
                    'current_page' => $decode_body['current_page'],
                ];
            }

            return $decode_body[static::KEY_RESPONSE];
        }

        return $decode_body;
    }

    /**
     * Decodes body.
     *
     * @param string $body
     *
     * @return mixed
     */
    protected function decodeBody(string $body)
    {
        $decoded_body = json_decode($body, true);

        if ($decoded_body === null || !is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    /**
     * @param string $method
     * @param array $params
     * @param string|null $access_token
     * @param array $options
     *
     * @return array
     */
    protected function configOptions(string $method, array $params = [], string $access_token = null, array $options = []): array
    {
        $_options = [
            'headers' => [],
            $method === 'GET' ? 'query' : 'form_params' => $params,
        ];

        if ($access_token === null && $this->access_token !== null) {
            $access_token = $this->access_token;
        }

        if ($access_token !== null) {
            $is_api_key = strlen($access_token) < 35;

            if ($is_api_key) {
                $_options['auth'] = [$access_token, ''];
            } else {
                $_options['headers']['Authorization'] = 'Bearer ' . $access_token;
            }
        }

        return array_merge($_options, $options);
    }
}
