<?php

namespace SofWar\Opskins\Actions;

use SofWar\Opskins\ApiRequest;
use SofWar\Opskins\Resources\EmptyObject;
use SofWar\Opskins\Resources\Helpers\CreateOffer;
use SofWar\Opskins\Resources\ITrade\GetApps;
use SofWar\Opskins\Resources\ITrade\GetOffer;
use SofWar\Opskins\Resources\ITrade\GetOfferAccept;
use SofWar\Opskins\Resources\ITrade\GetOffers;
use SofWar\Opskins\Resources\ITrade\GetTradeUrl;
use SofWar\Opskins\Resources\ITrade\GetUserInventory;

class ITrade
{
    /**
     * @var ApiRequest
     */
    private $request;

    public function __construct(ApiRequest $request)
    {
        $this->request = $request;
    }

    /***
     * Get an individual trade offer
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetOffer.md
     *
     * @param int $offer_id
     * @param string|null $access_token
     * @return GetOffer
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function get(int $offer_id, ?string $access_token = null): GetOffer
    {
        $params = [
            'offer_id' => $offer_id,
        ];

        $body = $this->request->get('ITrade/GetOffer', $params, [], $access_token);

        return new GetOffer($body, $this);
    }

    /**
     * Get user's trade offers.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetOffers.md
     *
     * @param int|null    $uid
     * @param string|null $state
     * @param string|null $type
     * @param string|null $ids
     * @param string      $sort
     * @param int         $page
     * @param int         $limit
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetOffers
     */
    public function lists(?int $uid = null, ?string $state = null, ?string $type = null, ?string $ids = null, $sort = 'created', int $page = 1, int $limit = 100, string $access_token = null): GetOffers
    {
        $params = [
            'uid'      => $uid,
            'state'    => $state,
            'type'     => $type,
            'ids'      => $ids,
            'sort'     => $sort,
            'page'     => $page,
            'per_page' => $limit,
        ];

        $body = $this->request->get('ITrade/GetOffers', $params, [], $access_token);

        return new GetOffers($body);
    }

    /**
     * Get all supported apps and their descriptions.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetApps.md
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetApps
     */
    public function apps(): GetApps
    {
        $body = $this->request->get('ITrade/GetApps');

        return new GetApps($body);
    }

    /**
     * Get User Inventory.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetUserInventory.md
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetUserInventoryFromSteamId.md
     *
     * @param int|string  $uid_or_steam_id
     * @param int         $app_id
     * @param string|null $search
     * @param int|null    $sort
     * @param int         $page
     * @param int         $limit
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetUserInventory
     */
    public function inventoryById($uid_or_steam_id, int $app_id, ?string $search = null, ?int $sort = null, int $page = 1, int $limit = 100, string $access_token = null): GetUserInventory
    {
        $isSteam = strlen((string) $uid_or_steam_id) >= 16;

        $params = [
            $isSteam ? 'steam_id' : 'uid' => $uid_or_steam_id,
            'app_id'                      => $app_id,
            'search'                      => $search,
            'sort'                        => $sort,
            'page'                        => $page,
            'per_page'                    => $limit,
        ];

        $body = $this->request->get('ITrade/GetUserInventory'.($isSteam ? 'FromSteamId' : ''), $params, [], $access_token);

        return new GetUserInventory($body);
    }

    /**
     * Get User Inventory.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetUserInventory.md
     *
     * @param string      $user_name
     * @param int         $app_id
     * @param string|null $search
     * @param int|null    $sort
     * @param int         $page
     * @param int         $limit
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetUserInventory
     */
    public function inventoryByName(string $user_name, int $app_id, ?string $search = null, ?int $sort = null, int $page = 1, int $limit = 100, string $access_token = null): GetUserInventory
    {
        $params = [
            'display_name' => $user_name,
            'app_id'       => $app_id,
            'search'       => $search,
            'sort'         => $sort,
            'page'         => $page,
            'per_page'     => $limit,
        ];

        $body = $this->request->get('ITrade/GetUserInventory', $params, [], $access_token);

        return new GetUserInventory($body);
    }

    /**
     * Get your account's trade URL.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/GetTradeUrl.md
     *
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetTradeUrl
     */
    public function tradeURL(?string $access_token = null): GetTradeUrl
    {
        $body = $this->request->get('ITrade/GetTradeURL', [], [], $access_token);

        return new GetTradeUrl($body);
    }

    /**
     * Regenerate your account's trade URL for P2P trading.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/RegenerateTradeUrl.md
     *
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetTradeUrl
     */
    public function regenerateTradeURL(?string $access_token = null): GetTradeUrl
    {
        $body = $this->request->post('ITrade/RegenerateTradeURL', [], [], $access_token);

        return new GetTradeUrl($body);
    }

    /**
     * Sends trade offer to another user including your and their items.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/SendOffer.md
     *
     * @param CreateOffer|array $data
     * @param string            $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetOffer
     */
    public function sendOffer($data, string $access_token = null): GetOffer
    {
        $params = [];
        $isSteam = false;

        if ($data instanceof CreateOffer) {
            $params = $data->toArray();

            $isSteam = $data->getIsSteamUid();
        } elseif (is_array($data)) {
            $params = $data;

            $isSteam = isset($data['steam_id']);
        }

        $body = $this->request->post('ITrade/SendOffer'.($isSteam ? 'ToSteamId' : ''), $params, [], $access_token);

        return new GetOffer($body, $this);
    }

    /**
     * Accepts offer sent by another user.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/AcceptOffer.md
     *
     * @param int         $offer_id
     * @param int         $twofactor_code
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetOfferAccept
     */
    public function acceptOffer(int $offer_id, int $twofactor_code, ?string $access_token = null): GetOfferAccept
    {
        $params = [
            'offer_id'       => $offer_id,
            'twofactor_code' => $twofactor_code,
        ];

        $body = $this->request->post('ITrade/AcceptOffer', $params, [], $access_token);

        return new GetOfferAccept($body);
    }

    /**
     * Cancels a trade offer.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/ITrade/CancelOffer.md
     *
     * @param int         $offer_id
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return GetOffer
     */
    public function cancelOffer(int $offer_id, string $access_token = null): GetOffer
    {
        $params = [
            'offer_id' => $offer_id,
        ];

        $body = $this->request->post('ITrade/CancelOffer', $params, [], $access_token);

        return new GetOffer((array) $body);
    }

    /**
     * Reports a trade offer
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IUser/UserReports.md
     *
     * @param string      $message
     * @param int         $offer_id
     * @param int         $report_type
     * @param string|null $access_token
     *
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     *
     * @return EmptyObject
     */
    public function reportOffer(string $message, int $offer_id, int $report_type = 3, string $access_token = null): EmptyObject
    {
        $params = [
            'message'     => $message,
            'offer_id'    => $offer_id,
            'report_type' => $report_type,
        ];

        $body = $this->request->post('IUser/UserReports', $params, [], $access_token);

        return new EmptyObject($body);
    }

    /**
     * @return ApiRequest
     */
    public function getRequest(): ApiRequest
    {
        return $this->request;
    }
}
