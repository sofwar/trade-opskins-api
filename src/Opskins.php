<?php

namespace SofWar\Opskins;

use SofWar\Opskins\Actions\ITest;
use SofWar\Opskins\Actions\ITrade;
use SofWar\Opskins\Actions\IUser;

class Opskins
{
    private $request;

    public $api_key;

    /**
     * Opskins constructor.
     * @param string|null $access_token
     * @param string $host
     * @param string $version
     */
    public function __construct(string $access_token = null, string $host = 'https://api-trade.opskins.com', string $version = 'v1')
    {
        $this->request = new ApiRequest($host, $version, $access_token);
    }

    public function getIUser(): IUser
    {
        return new IUser($this->request);
    }

    public function getITrade(): ITrade
    {
        return new ITrade($this->request);
    }

    public function getITest(): ITest
    {
        return new ITest($this->request);
    }

    public function setAccessToken(?string $access_token): void
    {
        $this->request->setAccessToken($access_token);
    }
}