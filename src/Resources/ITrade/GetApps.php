<?php

namespace SofWar\Opskins\Resources\ITrade;


use SofWar\Opskins\Resources\BaseModel;

class GetApps extends BaseModel
{
    /**
     * Internal App ID
     *
     * @var int
     */
    protected $app_id;

    /**
     * Steam App ID
     *
     * @var int
     */
    protected $steam_app_id;

    /**
     * Steam Context ID
     *
     * @var int
     */
    protected $steam_context_id;

    /**
     * Short name of app
     *
     * @var string
     */
    protected $name;

    /**
     * Long name of app
     *
     * @var string
     *
     */
    protected $long_name;

    /**
     * Image URL of app icon
     *
     * @var string
     * @example https://opskins.com/images/games/logo-small-vgo.jpg
     */
    protected $image;

    /**
     * Thumbnail image for app
     *
     * @var string
     * @example https://opskins.com/images/game-thumb-vgo.jpg
     */
    protected $image_thumb;

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->app_id = $data['internal_app_id'];
        $this->steam_app_id = $data['steam_app_id'];
        $this->steam_context_id = $data['steam_context_id'];
        $this->name = $data['name'];
        $this->long_name = $data['long_name'];
        $this->image = $data['img'];
        $this->image_thumb = $data['img_thumb'];
    }

    public function getAppId(): int
    {
        return $this->app_id;
    }

    public function getSteamAppId(): int
    {
        return $this->steam_app_id;
    }

    public function getSteamContextId(): int
    {
        return $this->steam_context_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLongName(): string
    {
        return $this->long_name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getImageThumb(): string
    {
        return $this->image_thumb;
    }
}