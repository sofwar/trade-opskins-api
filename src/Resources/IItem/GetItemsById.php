<?php

namespace SofWar\Opskins\Resources\IItem;


use SofWar\Opskins\Actions\IItem;
use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\Item;

class GetItemsById extends BaseModel
{
    /**
     * Items
     * @var array
     */
    protected $items = [];

    /**
     * @var array
     */
    protected $unknown_items = [];

    public function __construct(array $data, IItem $IItem = null)
    {
        $this->source = $data;

        $this->items = [];
        $this->unknown_items = $data['unknown_items'] ?? [];

        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $this->items[] = new Item($item, $IItem);
            }
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getUnknownItems(): array
    {
        return $this->unknown_items;
    }
}