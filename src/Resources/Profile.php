<?php

namespace SofWar\Opskins\Resources;

use SofWar\Opskins\Actions\IUser;
use SofWar\Opskins\Resources\Helpers\UpdateProfile;

class Profile extends BaseModel
{
    /**
     * OPSkins.com User ID
     * @var int
     */
    protected $id;

    /**
     * Steam ID64
     * @var string
     *
     */
    protected $steam_id;

    /**
     * Display name
     * @var string
     */
    protected $display_name;

    /**
     * URL to avatar
     * @var string
     */
    protected $avatar;

    /**
     * Whether or not user has Two-Factor Auth enabled.
     * @var boolean
     */
    protected $twofactor_enabled;

    /**
     * See whether user has an API Key
     * @var boolean
     */
    protected $api_key_exists;

    /**
     * (Optional via with_extra) Phone number used for SMS verification
     * @var string|null
     */
    protected $sms_phone;

    /**
     * Email address. Optional via with_extra, but it is always outputted with identity_basic OAuth Scope.
     * @var string|null
     */
    protected $contact_email;

    /**
     * (Optional via with_extra) See whether inventory is private (no one can see it, even with a token)
     * @var boolean|null
     */
    protected $inventory_is_private;

    /**
     * Allow Two Factor code reuse for certain features (Send Offer, Accept Offer)
     * @var boolean|null
     */
    protected $allow_twofactor_code_reuse;

    /**
     * Auto-accept gift trade offers
     * @var boolean|null
     */
    protected $auto_accept_gift_trades;

    /**
     * Hide username in WAX transaction records
     * @var bool|null
     */
    protected $anonymous_transactions;

    /**
     * VGO CASE USER
     * @var bool|null
     */
    protected $vcase_restricted;

    /**
     * @var IUser
     */
    private $IUser;

    public function __construct(array $data, IUser $IUser = null)
    {
        $this->IUser = $IUser;

        $this->_update_data($data);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSteamId(): string
    {
        return $this->steam_id;
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getTwoFactorEnabled(): ?bool
    {
        return $this->twofactor_enabled;
    }

    public function getApiKeyExits(): ?bool
    {
        return $this->api_key_exists;
    }

    public function getSmsPhone(): ?bool
    {
        return $this->sms_phone;
    }

    public function getContactEmail(): ?bool
    {
        return $this->contact_email;
    }

    public function getInventoryIsPrivate(): ?bool
    {
        return $this->inventory_is_private;
    }

    public function getAllowTwoFactorCodeReuse(): ?bool
    {
        return $this->allow_twofactor_code_reuse;
    }

    public function getAutoAcceptGiftTrades(): ?bool
    {
        return $this->auto_accept_gift_trades;
    }

    public function getAnonymousTransactions(): ?bool
    {
        return $this->anonymous_transactions;
    }

    /**
     * @param UpdateProfile|$data
     * @param string|null $access_token
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     * @throws \SofWar\Opskins\Exceptions\OpskinsClientException
     */
    public function update($data, string $access_token = null): void
    {
        $body = $this->IUser->update($data, $access_token);

        $this->_update_data(['user' => (array)$body]);
    }


    private function _update_data(array $data): void
    {
        $this->source = $data;

        $user = $data['user'] ?? $data;

        $this->id = $user['id'];
        $this->steam_id = $user['steam_id'];
        $this->display_name = $user['display_name'];
        $this->avatar = $user['avatar'];

        $this->twofactor_enabled = $user['twofactor_enabled'] ?? null;
        $this->api_key_exists = $user['api_key_exists'] ?? null;
        $this->sms_phone = $user['sms_phone'] ?? null;
        $this->contact_email = $user['contact_email'] ?? null;
        $this->inventory_is_private = $user['inventory_is_private'] ?? null;
        $this->allow_twofactor_code_reuse = $user['allow_twofactor_code_reuse'] ?? null;
        $this->auto_accept_gift_trades = $user['auto_accept_gift_trades'] ?? null;
        $this->anonymous_transactions = $user['anonymous_transactions'] ?? null;
        $this->vcase_restricted = $user['vcase_restricted'] ?? false;
    }
}