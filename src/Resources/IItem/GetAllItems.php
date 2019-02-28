<?php

namespace SofWar\Opskins\Resources\IItem;

use SofWar\Opskins\Actions\IItem;
use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\Item;

class GetAllItems extends BaseModel
{
    /**
     * @var array
     */
    protected $items = [];

    public function __construct(array $data, IItem $IItem = null)
    {
        $this->source = $data;

        $this->items = [];

        foreach ($data['items'] as $item) {
            $this->items[] = new Item($item, $IItem);
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }
}