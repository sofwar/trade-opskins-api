<?php

require('../vendor/autoload.php');

use SofWar\Opskins\Opskins;
use SofWar\Opskins\Exceptions\OpskinsApiException;


$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

/*
try {
    $params = new \SofWar\Opskins\Resources\Helpers\CreateOffer([
        //'uid' => 1444404,
        //'token' => 'Xsm3XY6D',
        'trade_url' => 'https://trade.opskins.com/trade/userid/1444404/token/Xsm3XY6D',
        'message' => 'Test trade message',
        'expiration_time' => 180,
        'items_to_receive' => [11182571, 123333],
        'items_to_send' => [123345],
        'twofactor_code' => 123456
    ]);

    $offer = $opskins->getITrade()->sendOffer($params);

    print_r($offer);


} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
*/

try {
    $params = new \SofWar\Opskins\Resources\Helpers\CreateOffer();

    //
    $params->setTradeUrl('https://trade.opskins.com/trade/userid/1444404/token/Xsm3XY6D');
    // OR
    //$params->setUid(1444404);
    //$params->setToken('Xsm3XY6D');
    //

    $params->setMessage('Test trade message');
    $params->setExpirationTime(180);
    $params->addItemReceive(11182571);

    $params->setTwoFactorCode(856591);

    $offer = $opskins->getITrade()->sendOffer($params);

    print_r($offer);


} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}