<?php

namespace SofWar\Opskins\Resources\ITrade;

use SofWar\Opskins\Resources\BaseModel;

class GetTradeUrl extends BaseModel
{
    /**
     * OPSkins.com User ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Your trade token.
     *
     * @var string
     */
    protected $token;

    /**
     * The actual URL someone should go to in order to send a trade offer to your account.
     *
     * @var string
     */
    protected $long_url;

    /**
     * A shortened alias for long_url of the type ".../t/1/Lhn9d7fVL1U". This redirects to the long URL.
     *
     * @var string
     */
    protected $short_url;

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->id = $data['uid'];
        $this->token = $data['token'];
        $this->long_url = $data['long_url'];
        $this->short_url = $data['short_url'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getLongUrl(): string
    {
        return $this->long_url;
    }

    public function getShortUrl(): string
    {
        return $this->short_url;
    }
}
