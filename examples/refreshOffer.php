<?php

require('../vendor/autoload.php');

use SofWar\Opskins\Opskins;
use SofWar\Opskins\Exceptions\OpskinsApiException;


$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $offer = $opskins->getITrade()->get(14476115);

    $offer->refresh();

    print_r($offer);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}