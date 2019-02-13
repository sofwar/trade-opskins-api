<?php

namespace SofWar\Opskins\Resources\Helpers;


class CreateOffer
{
    /**
     * User ID Opskins or Steam ID
     *
     * @var int|string
     *
     */
    protected $uid;

    /**
     * Trade token of user you want to send your trade offer to
     *
     * @var string
     */
    protected $token;

    /**
     * Trade URL of the user you want to send your trade offer to.
     *
     * @var string
     */
    protected $trade_url;

    /**
     * Custom expiration time for an offer in seconds. Minimum 120 seconds (2 minutes). Defaults to 14 days.
     *
     * @var int
     */
    protected $expiration_time;

    /**
     * 2-factor authentication code
     *
     * @var int
     */
    protected $twofactor_code;

    /**
     * Trade offer message that will be displayed to the recipient
     *
     * @var string
     */
    protected $message;

    /**
     * A comma-separated list of (int) Item IDs you wish to send to recipient.
     *
     * @var array
     */
    protected $items_to_send = [];

    /**
     * A comma-separated list of (int) Item IDs you wish to receive from the recipient.
     *
     * @var array
     */
    protected $items_to_receive = [];

    public function __construct(array $data = [])
    {
        $this->uid = $data['uid'] ?? null;
        $this->token = $data['token'] ?? null;
        $this->trade_url = $data['trade_url'] ?? null;
        $this->message = $data['expiration_time'] ?? null;

        $this->items_to_send = $data['items_to_send'] ?? [];
        $this->items_to_receive = $data['items_to_receive'] ?? [];

        $this->twofactor_code = $data['twofactor_code'] ?? null;
        $this->expiration_time = $data['expiration_time'] ?? null;
    }

    public function setUid($value): void
    {
        $this->uid = $value;
    }

    public function setToken(string $value): void
    {
        $this->token = $value;
    }

    public function setTradeUrl(string $value): void
    {
        $this->trade_url = $value;
    }

    public function setMessage(string $value): void
    {
        $this->message = $value;
    }

    public function setItemsSend(array $value): void
    {
        $this->items_to_send = $value;
    }

    public function setItemsReceive(array $value): void
    {
        $this->items_to_receive = $value;
    }

    public function setTwoFactorCode(int $value): void
    {
        $this->twofactor_code = $value;
    }

    public function setExpirationTime(?int $value): void
    {
        $this->expiration_time = $value;
    }

    public function getIsSteamUid(): bool
    {
        return strlen((string)$this->uid) >= 16;
    }

    public function toArray(): array
    {
        return [
            'uid' => $this->uid,
            'token' => $this->token,
            'message' => $this->message,
            'trade_url' => $this->trade_url,
            'twofactor_code' => $this->twofactor_code,
            'expiration_time' => $this->expiration_time,
            'items_to_send' => implode(',', $this->items_to_send),
            'items_to_receive' => implode(',', $this->items_to_receive)
        ];
    }

    public function addItemSend(int $item_id): void
    {
        $this->items_to_send[] = $item_id;
    }

    public function addItemReceive(int $item_id): void
    {
        $this->items_to_receive[] = $item_id;
    }

    public function removeItemSend(int $item_id): void
    {
        $index = array_search($item_id, $this->items_to_send, false);

        if ($index !== false) {
            unset($this->items_to_send[$index]);
        }
    }

    public function removeItemReceive(int $item_id): void
    {
        $index = array_search($item_id, $this->items_to_receive, false);

        if ($index !== false) {
            unset($this->items_to_receive[$index]);
        }
    }
}