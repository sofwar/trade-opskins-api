<?php

namespace SofWar\Opskins\Resources;

class OfferUser extends BaseModel
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

    /**
     * Is this user verified on OPSkins by support?
     *
     * @var bool
     */
    protected $verified;

    /**
     * Items which Sender/Recipient offered for trade in the offer.
     *
     * @var array
     */
    protected $items = [];

    public function __construct($data)
    {
        $this->source = $data;

        $this->id = $data['uid'];
        $this->steam_id = empty($data['steam_id']) ? null : $data['steam_id'];
        $this->name = $data['display_name'];
        $this->avatar = $data['avatar'];
        $this->verified = $data['verified'];

        $this->items = [];

        foreach ($data['items'] as $item) {
            $this->items[] = new Item($item);
        }
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

    public function getVerified(): bool
    {
        return $this->verified;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
