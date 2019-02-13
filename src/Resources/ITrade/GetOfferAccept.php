<?php

namespace SofWar\Opskins\Resources\ITrade;

use SofWar\Opskins\Resources\BaseModel;
use SofWar\Opskins\Resources\Item;
use SofWar\Opskins\Resources\Offer;

class GetOfferAccept extends BaseModel
{
    /**
     * @var Offer
     */
    protected $offer;

    /**
     * New items for the recipient.
     *
     * @var array
     */
    protected $new_items = [];

    /**
     * A count of failed case openings, 0 if none failed.
     *
     * @var int
     */
    protected $failed_cases = 0;

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->failed_cases = $data['failed_cases'] ?? 0;

        $this->offer = new Offer($data['offer']);

        $this->new_items = [];

        foreach ($data['new_items'] as $item) {
            $this->new_items[] = new Item($item);
        }
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function getNewItems(): array
    {
        return $this->new_items;
    }

    public function getFailedCases(): int
    {
        return $this->failed_cases;
    }
}
