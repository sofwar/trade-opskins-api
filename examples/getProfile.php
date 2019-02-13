<?php

require('../vendor/autoload.php');

use SofWar\Opskins\Opskins;
use SofWar\Opskins\Exceptions\OpskinsApiException;


$opskins = new Opskins();

$opskins->setAccessToken('ACCESS_TOKEN');

try {
    $profile = $opskins->getIUser()->get(1);

    print_r($profile);
} catch (OpskinsApiException $e) {
    print_r($e->getMessage());
}