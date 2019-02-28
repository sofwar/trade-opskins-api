<?php

namespace SofWar\Opskins\Actions;

use SofWar\Opskins\ApiRequest;
use SofWar\Opskins\Enum\AppType;
use SofWar\Opskins\Enum\CurrencyType;
use SofWar\Opskins\Exceptions\OpskinsClientException;
use SofWar\Opskins\Resources\EmptyObject;
use SofWar\Opskins\Resources\IItem\GetAllItems;
use SofWar\Opskins\Resources\IItem\GetItemsById;
use SofWar\Opskins\Resources\IItem\GetRarityStats;
use SofWar\Opskins\Resources\IItem\InstantSellRecentItems;
use SofWar\Opskins\Resources\IItem\WithdrawToOpskins;
use SofWar\Opskins\Resources\IUser\CreateVCaseUser;
use SofWar\Opskins\Resources\IUser\GetProfile;
use SofWar\Opskins\Resources\IUser\Inventory;
use SofWar\Opskins\Resources\IUser\UpdateProfile;

class IItem
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
     * Get All Items
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IItem/GetAllItems.md
     *
     * @param int $app_id
     * @param string|null $sku
     * @param string|null $name
     * @param int|null $sort
     * @param int $page
     * @param int $per_page
     * @param string|null $access_token
     * @return GetAllItems
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function all(int $app_id, ?string $sku = null, ?string $name = null, ?int $sort = null, int $page = 1, int $per_page = 100, ?string $access_token = null): GetAllItems
    {
        $params = [
            'app_id' => $app_id,
            'sku' => $sku,
            'name' => $name,
            'sort' => $sort,
            'page' => $page,
            'per_page' => $per_page
        ];

        $body = $this->request->get('IItem/GetAllItems', $params, [], $access_token);

        return new GetAllItems($body, $this);
    }

    /**
     * Get user items by id numbers.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IItem/GetItemsById.md
     *
     * @param string|array $items
     * @param string|null $access_token
     * @return GetItemsById
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function listsById($items, ?string $access_token = null): GetItemsById
    {
        if (is_array($items)) {
            $items = implode(',', $items);
        }

        $params = [
            'item_id' => $items
        ];

        $body = $this->request->get('IItem/GetItemsById', $params, [], $access_token);

        return new GetItemsById($body, $this);
    }

    /**
     * Get item rarity stats per Definition ID (SKU) (currently only for VGO)
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IItem/GetRarityStats.md
     *
     * @param string|array $def_id
     * @param string|null $access_token
     * @return GetRarityStats
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function rarityStats($def_id = null, ?string $access_token = null): GetRarityStats
    {
        if (is_array($def_id)) {
            $def_id = implode(',', $def_id);
        }

        $params = [
            'app_id' => AppType::VGO,
            'def_id' => $def_id
        ];

        $body = $this->request->get('IItem/GetRarityStats', $params, [], $access_token);

        return new GetRarityStats($body);
    }

    /**
     * Instant Sell Recent Items
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IItem/InstantSellRecentItems.md
     *
     * @param $items
     * @param int $currency_id
     * @param string|null $access_token
     * @return InstantSellRecentItems
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function instantSellRecentItems($items, int $currency_id = CurrencyType::USD, ?string $access_token = null): InstantSellRecentItems
    {
        if (is_array($items)) {
            $items = implode(',', $items);
        }

        $params = [
            'item_id' => $items,
            'instant_sell_type' => $currency_id
        ];

        $body = $this->request->post('IItem/InstantSellRecentItems', $params, [], $access_token);

        return new InstantSellRecentItems($body);
    }

    /**
     * Withdraw items to OPSkins on-site inventory.
     *
     * https://github.com/OPSkins/trade-opskins-api/blob/master/IItem/WithdrawToOpskins.md
     *
     * @param $items
     * @param string|null $access_token
     * @return WithdrawToOpskins
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function withdrawToOpskins($items, ?string $access_token = null): WithdrawToOpskins
    {
        if (is_array($items)) {
            $items = implode(',', $items);
        }

        $params = [
            'item_id' => $items
        ];

        $body = $this->request->post('IItem/WithdrawToOpskins', $params, [], $access_token);

        return new WithdrawToOpskins($body);
    }
}
