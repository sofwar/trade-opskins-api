<?php

namespace SofWar\Opskins;


use GuzzleHttp\Client;
use SofWar\Opskins\Exceptions\OpskinsOAuthException;

class OpskinsOAuth
{
    protected const VERSION = 'v1';
    protected const CONNECTION_TIMEOUT = 5;
    protected const HOST = 'https://oauth.opskins.com';

    private const ENDPOINT_AUTHORIZE = '/authorize';
    private const ENDPOINT_ACCESS_TOKEN = '/access_token';
    private const ENDPOINT_REVOKE_TOKEN = '/revoke_token';

    /**
     * @var ApiRequest
     */
    private $api_client;

    /**
     * @var string
     */
    private $version;

    /**
     * @var static
     */
    private $host;

    /**
     * @var string
     */
    private $client_id;

    /**
     * @var string
     */
    private $clinet_secret;

    public function __construct(string $client_id, ?string $client_secret = null, string $version = self::VERSION)
    {
        $this->host = self::HOST . $version;

        $this->version = $version;
        $this->client_id = $client_id;
        $this->clinet_secret = $client_secret;

        $this->api_client = new Client([
            'base_uri' => self::HOST,
            'timeout' => self::CONNECTION_TIMEOUT,
            'http_errors' => false
        ]);
    }

    /**
     * Get authorize url
     *
     * @param string $state
     * @param array $scopes
     * @param string|null $duration
     * @param int $mobile
     * @return string
     */
    public function getAuthorizeUrl(string $state, array $scopes = ['identity_basic'], ?string $duration = null, int $mobile = 0): string
    {
        $params = [
            'client_id' => $this->client_id,
            'response_type' => 'code',
            'state' => $state,
            'scope' => implode(',', $scopes),
            'mobile' => $mobile,
            'duration' => $duration
        ];

        return $this->host . self::ENDPOINT_AUTHORIZE . '?' . http_build_query($params);
    }

    public function getAccessToken(string $code)
    {
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $code
        ];

        $response = $this->api_client->post($this->version . self::ENDPOINT_ACCESS_TOKEN, [
            'form_params' => $params,
            'auth' => [$this->client_id, $this->clinet_secret]
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        if (isset($body['error'])) {
            throw new OpskinsOAuthException($body['error_description']);
        }

        return $body;
    }

    public function refreshAccessToken(string $token)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token
        ];

        $response = $this->api_client->post($this->version . self::ENDPOINT_ACCESS_TOKEN, [
            'form_params' => $params,
            'auth' => [$this->client_id, $this->clinet_secret]
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        if (isset($body['error'])) {
            throw new OpskinsOAuthException($body['error_description']);
        }

        return $body;
    }

    public function revokeAccessToken(string $token)
    {
        $params = [
            'token_type' => 'refresh',
            'token' => $token
        ];

        $response = $this->api_client->post($this->version . self::ENDPOINT_REVOKE_TOKEN, [
            'form_params' => $params,
            'auth' => [$this->client_id, $this->clinet_secret]
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        if (isset($body['error'])) {
            throw new OpskinsOAuthException($body['error_description']);
        }

        return $body;
    }
}