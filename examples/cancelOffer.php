<?php

require '../vendor/autoload.php';

use SofWar\Opskins\Exceptions\OpskinsApiException;
use SofWar\Opskins\Opskins;

$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

$offer_id = 14476115;

/*
try {
    $offer = $opskins->getITrade()->get($offer_id);

    $offer->cancel();

    print_r($offer);


} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
*/

try {
    $offer = $opskins->getITrade()->cancelOffer($offer_id);

    print_r($offer);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
