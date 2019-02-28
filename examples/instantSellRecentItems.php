<?php

require '../vendor/autoload.php';

use SofWar\Opskins\Exceptions\OpskinsApiException;
use SofWar\Opskins\Exceptions\OpskinsClientException;
use SofWar\Opskins\Opskins;

$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $sellItems = $opskins->getIItem()->instantSellRecentItems([3524708]);

    print_r($sellItems);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}

//OR

try {

    $items = $opskins->getIItem()->listsById([3524708, 3524709]);

    /**
     * @var \SofWar\Opskins\Resources\Item  $item
     */
    foreach ($items as $item) {
        try {
            $item->instantSell();
        } catch (OpskinsClientException $e) {
            print_r($e->getMessage());
        }
    }
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
