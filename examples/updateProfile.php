<?php

require '../vendor/autoload.php';

use SofWar\Opskins\Exceptions\OpskinsApiException;
use SofWar\Opskins\Opskins;

$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $config = new \SofWar\Opskins\Resources\Helpers\UpdateProfile();

    $config->setDisplayName('Test name account');
    $config->setAnonymousTransactions(true);

    $profile = $opskins->getIUser()->update($config);

    print_r($profile);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}
