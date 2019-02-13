<?php

namespace SofWar\Opskins\Resources\Helpers;


class UpdateProfile
{
    /**
     * Name to display on trade offers
     *
     * @var string|null
     */
    protected $display_name;

    /**
     * Whether inventory is private (nobody can see it, even with token)
     *
     * @var bool|null
     */
    protected $inventory_is_private;

    /**
     * Hide my username in WAX transaction records
     *
     * @var bool|null
     */
    protected $anonymous_transactions;

    /**
     * Auto-accept gift trade offers
     *
     * @var bool|null
     */
    protected $auto_accept_gift_trades;

    /**
     * Allow Two Factor code reuse for certain features (Send Offer, Accept Offer)
     *
     * @var bool|null
     */
    protected $allow_twofactor_code_reuse;

    public function __construct(array $data = [])
    {
        $this->display_name = $data['display_name'] ?? null;
        $this->inventory_is_private = $data['inventory_is_private'] ?? null;
        $this->anonymous_transactions = $data['anonymous_transactions'] ?? null;
        $this->auto_accept_gift_trades = $data['auto_accept_gift_trades'] ?? null;
        $this->allow_twofactor_code_reuse = $data['allow_twofactor_code_reuse'] ?? null;
    }

    public function setDisplayName(string $value): void
    {
        $this->display_name = $value;
    }

    public function setInventoryIsPrivate(bool $value): void
    {
        $this->inventory_is_private = $value;
    }

    public function setAnonymousTransactions(bool $value): void
    {
        $this->anonymous_transactions = $value;
    }

    public function setAutoAcceptGiftTrades(bool $value): void
    {
        $this->auto_accept_gift_trades = $value;
    }

    public function setAllowTwofactorCodeReuse(bool $value): void
    {
        $this->allow_twofactor_code_reuse = $value;
    }

    public function toArray(): array
    {
        return [
            'display_name' => $this->display_name,
            'inventory_is_private' => $this->inventory_is_private,
            'anonymous_transactions' => $this->anonymous_transactions,
            'auto_accept_gift_trades' => $this->auto_accept_gift_trades,
            'allow_twofactor_code_reuse' => $this->allow_twofactor_code_reuse
        ];
    }
}