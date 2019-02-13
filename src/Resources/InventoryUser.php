<?php

namespace SofWar\Opskins\Resources;

class InventoryUser extends BaseModel
{
    /**
     * OPSkins.com User ID.
     *
     * @var int
     */
    protected $id;

    /**
     * SteamID.
     *
     * @var string|null
     */
    protected $steam_id;

    /**
     * User display name.
     *
     * @var string
     */
    protected $name;

    /**
     * User Avatar image URL.
     *
     * @var string
     */
    protected $avatar;

    public function __construct($data)
    {
        $this->source = $data;

        $this->id = $data['uid'];
        $this->steam_id = empty($data['steam_id']) ? null : $data['steam_id'];
        $this->name = $data['username'];
        $this->avatar = $data['avatar'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSteamId(): ?string
    {
        return $this->steam_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
}
