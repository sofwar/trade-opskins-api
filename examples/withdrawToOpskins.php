<?php

require '../vendor/autoload.php';

use SofWar\Opskins\Exceptions\OpskinsApiException;
use SofWar\Opskins\Opskins;

$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $items = $opskins->getIItem()->withdrawToOpskins([3524708]);

    print_r($items);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
