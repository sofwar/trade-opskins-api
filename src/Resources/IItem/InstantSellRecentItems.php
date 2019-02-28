<?php

namespace SofWar\Opskins\Resources\IItem;


use SofWar\Opskins\Resources\BaseModel;

class InstantSellRecentItems extends BaseModel
{
    /**
     * Item IDs considered valid
     *
     * @var array
     */
    protected $valid_item_ids = [];

    /**
     * Item IDs that were not found in the database or do not belong to you
     *
     * @var array
     */
    protected $unknown_item_ids = [];

    /**
     * Item IDs created more than 15 minutes ago, which are not eligible
     *
     * @var array
     */
    protected $not_recent_item_ids = [];

    /**
     * Item IDs that are currently not eligible for trade or transfer
     *
     * @var array
     */
    protected $ineligible_item_ids = [];

    /**
     * @var object
     */
    protected $isales_instant_sell_items;

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->valid_item_ids = $data['valid_item_ids'];
        $this->unknown_item_ids = $data['unknown_item_ids'];
        $this->not_recent_item_ids = $data['not_recent_item_ids'];
        $this->ineligible_item_ids = $data['ineligible_item_ids'];

        $this->isales_instant_sell_items = $data['isales_instantsellitems_v1'];
    }

    public function getValidItemIds(): array
    {
        return $this->valid_item_ids;
    }

    public function getUnknownItemIds(): array
    {
        return $this->unknown_item_ids;
    }

    public function getNotRecentItemIds(): array
    {
        return $this->not_recent_item_ids;
    }

    public function getIneligibleItemIds(): array
    {
        return $this->ineligible_item_ids;
    }

    public function getIsalesInstantSellItems(): array
    {
        return $this->isales_instant_sell_items;
    }
}