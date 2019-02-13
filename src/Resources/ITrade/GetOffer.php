<?php

namespace SofWar\Opskins\Resources\ITrade;


use SofWar\Opskins\Actions\ITrade;
use SofWar\Opskins\Resources\Offer;

class GetOffer extends Offer
{
    public function __construct(array $data, ITrade $ITrade = null)
    {
        $data = $data['offer'] ?? $data;

        parent::__construct($data, $ITrade);
    }
}