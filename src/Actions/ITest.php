<?php

namespace SofWar\Opskins\Actions;

use SofWar\Opskins\ApiRequest;
use SofWar\Opskins\Resources\EmptyObject;
use SofWar\Opskins\Resources\ITest\Body as TestBody;
use SofWar\Opskins\Resources\ITest\UserId as TestUserId;

class ITest
{
    /**
     * @var ApiRequest
     */
    private $request;

    public function __construct(ApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * A test endpoint that doesn't require authentication and doesn't return anything information other than the default status and time fields.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITest.md#test-v1
     *
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return EmptyObject
     */
    public function get(?string $access_token = null): EmptyObject
    {
        $body = $this->request->get('ITest/Test', [], [], $access_token);

        return new EmptyObject($body);
    }

    /**
     * Test authed user.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITest.md#testauthed-v1
     *
     * @param string $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return TestUserId
     */
    public function userId(string $access_token = null): TestUserId
    {
        $body = $this->request->get('ITest/TestAuthed', [], [], $access_token);

        return new TestUserId($body);
    }

    /**
     * Return everything that was sent as input.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITest.md#testbody-v1
     *
     * @param string $method
     * @param string $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return TestBody
     */
    public function body(string $method, string $access_token = null): TestBody
    {
        if ($method === 'GET') {
            $body = $this->request->get('ITest/TestBody', [], [], $access_token);
        } else {
            $body = $this->request->post('ITest/TestBody', [], [], $access_token);
        }

        return new TestBody($body);
    }
}
