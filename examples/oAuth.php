<?php
require '../vendor/autoload.php';

$client_id = 'XXXXXXXXX';
$client_secret = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

$oAuth = new \SofWar\Opskins\OpskinsOAuth($client_id, $client_secret);

if (!isset($_GET['code'])) {
    $browser_url = $oAuth->getAuthorizeUrl('tester');

    header('Location:' . $browser_url);
}

try {
    $response = $oAuth->getAccessToken($_GET['code']);

    print_r($response);
} catch (\SofWar\Opskins\Exceptions\OpskinsOAuthException $e) {
    echo 'Something went wrong.';
    echo $e->getMessage();
}