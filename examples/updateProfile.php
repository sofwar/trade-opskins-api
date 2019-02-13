<?php

require('../vendor/autoload.php');

use SofWar\Opskins\Opskins;
use SofWar\Opskins\Exceptions\OpskinsApiException;


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