<?php

namespace SofWar\Opskins\Resources\ITrade;

use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\MetaData;
use SofWar\Opskins\Resources\Offer;

class GetOffers extends BaseModel
{
    /**
     * Total number of offers matching the input filters.
     *
     * @var int
     */
    protected $total;

    /**
     * @var MetaData
     */
    protected $metadata;

    /**
     * Lists offers.
     *
     * @var array
     */
    protected $offers = [];

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->total = $data['total'];
        $this->metadata = new MetaData($data['metadata']);
        $this->offers = [];

        foreach ($data['offers'] as $offer) {
            $this->offers[] = new Offer($offer);
        }
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getOffers(): array
    {
        return $this->offers;
    }

    public function getMetaData(): MetaData
    {
        return $this->metadata;
    }
}
