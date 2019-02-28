<?php

namespace SofWar\Opskins\Resources\IItem;


use SofWar\Opskins\Resources\BaseModel;

class GetRarityStats extends BaseModel
{
    /**
     * Object containing rarity data per Definition ID
     *
     * @var array
     */
    protected $items = [];

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->items = $data['items'] ?? [];
    }

    public function getItems(): array
    {
        return $this->items;
    }
}