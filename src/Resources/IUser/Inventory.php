<?php

namespace SofWar\Opskins\Resources\IUser;

use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\Item;
use SofWar\Opskins\Resources\MetaData;

class Inventory extends BaseModel
{
    /**
     * Total number of items (filtered, if search parameter is passed).
     *
     * @var int
     */
    protected $total;

    /**
     * Items list.
     *
     * @var array
     */
    protected $items;

    /**
     * List of Item IDs and matching Offer IDs that are involved in active trade offers. Keys are Item IDs and values are an array of Offer IDs.
     *
     * @var array
     */
    protected $items_in_active_offers;

    /**
     * @var MetaData
     */
    protected $metadata;

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->total = (int) ($data['total'] ?? 0);
        $this->metadata = new MetaData($data['metadata'] ?? []);

        $this->items = [];
        $this->items_in_active_offers = $data['items_in_active_offers'] ?? [];

        foreach ($data['items'] as $item) {
            $this->items[] = new Item($item);
        }
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getItemsInActiveOffers(): array
    {
        return $this->items_in_active_offers;
    }

    public function getMetaData(): MetaData
    {
        return $this->metadata;
    }
}
