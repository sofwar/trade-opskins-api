<?php

namespace SofWar\Opskins\Resources\IUser;

use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\Profile;

class CreateVCaseUser extends BaseModel
{
    /**
     * @var Profile
     */
    protected $user;

    /**
     * User API key. Keep it in a safe place and use it to access ICaseSite endpoints.
     *
     * @var string
     */
    protected $api_key;

    public function __construct($data)
    {
        $this->source = $data;

        $this->api_key = $data['api_key'];
        $this->user = new Profile($data['user']);
    }
}
