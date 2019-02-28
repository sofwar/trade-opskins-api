<?php

require '../vendor/autoload.php';

use SofWar\Opskins\Exceptions\OpskinsApiException;
use SofWar\Opskins\Opskins;

$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $items = $opskins->getIItem()->all(\SofWar\Opskins\Enum\AppType::VGO);

    print_r($items);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
