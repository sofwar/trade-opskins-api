# Opskins Trade PHP Library

[![Latest Stable Version](https://poser.pugx.org/sofwar/trade-opskins-api/v/stable)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![Total Downloads](https://poser.pugx.org/sofwar/trade-opskins-api/downloads)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![Latest Unstable Version](https://poser.pugx.org/sofwar/trade-opskins-api/v/unstable)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![License](https://poser.pugx.org/sofwar/trade-opskins-api/license)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![StyleCI](https://styleci.io/repos/170465419/shield)](https://styleci.io/repos/170465419)

This is the unofficial client library for the [Opskins Trade API][1]. We provide an intuitive, stable interface to integrate Opskins Trade API into your PHP project.

## Installation

Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md) if you are unfamiliar with Composer or dependency managers in general.

```text
composer require sofwar/trade-opskins-api
```

```text
require __DIR__.'/../vendor/autoload.php';

$opskins = new \SofWar\Opskins\Opskins();
```

## Access Token 
You can use both a user access token and api key
```text
ACCESS_TOKEN = XXXXXXXABH5IABYKNAAAABlcY8Lgurj5K+LRRA3UYeg2e3OQaXWLZC3OKXXrxjxCFof5YHQ=
ACCESS_TOKEN = xxxxb65b683xxde1553892d3b1xxx
```

## Initialization

```php
$opskins = new Opskins();
```

Also you can initialize Opskins with the default access token

```php
$opskins = new Opskins('ACCESS_TOKEN');   
```
OR
```php 
$opskins = new Opskins(');  
$opskins->setAccessToken('ACCESS_TOKEN'); 
```

## Authorization
The library provides the authorization flows for user based on OAuth 2.0 protocol implementation in Opskins API. Please read the full [documentation][3] before you start.

### Authorization Code Flow
For getting user access key use following command:

```php

$client_id = 'XXXXX';
$client_secret = 'XXXXXXXXXXXX';

$oauth = new \SofWar\Opskins\OpskinsOAuth($client_id, $client_secret);

$state = 'secret_state_code';

$browser_url = $oauth->getAuthorizeUrl($state, ['identity_basic', 'items']);
```

After successful authorization user's browser will be redirected to the specified redirect_uri. Meanwhile the code will be sent as a GET parameter to the specified address:

```text
https://example.com?code=CODE&state=STATE
```
Then use this method to get the access token:

```php

$client_id = 'XXXXX';
$client_secret = 'XXXXXXXXXXXX';

$oauth = new \SofWar\Opskins\OpskinsOAuth($client_id, $client_secret);

$response = $oauth->getAccessToken($_GET['code']);

$access_token = $response['access_token'];
```

## API Request
You can find the full list of Opskins Trade API methods [here][1].

## Examples

All examples can be found [here][2]

## TODO
- [ ] ICase
    - [ ] GetCaseSchema
    - [ ] GetCaseOdds
    - [ ] GetMinimumOpenVolume
    - [ ] OpenWithKeys
- [ ] ICaseSite
    - [ ] GetKeyCount
    - [ ] GetTradeStatus
    - [ ] SendKeyRequest
    - [ ] UpdateCommissionSettings
- [ ] IEthereum
    - [ ] GetContractAddress
- [ ] IItem
    - [ ] GetAllItems
    - [ ] GetItemsById
    - [ ] WithdrawToOpskins
    - [ ] GetItemDefinitions
    - [ ] GetRarityStats
    - [ ] InstantSellRecentItems
- [X] ITest
    - [X] Test
    - [X] TestAuthed
    - [X] TestBody
- [X] ITrade
    - [X] AcceptOffer
    - [X] CancelOffer
    - [X] GetApps
    - [X] GetOffer
    - [X] GetOffers
    - [X] GetTradeURL
    - [X] GetUserInventory
    - [X] GetUserInventoryFromSteamId
    - [X] RegenerateTradeUrl
    - [X] SendOffer
    - [X] SendOfferToSteamId
- [X] IUser
    - [X] CreateVCaseUser
    - [X] GetInventory
    - [X] GetProfile
    - [X] UpdateProfile
    - [X] UserReports


[1]: https://github.com/OPSkins/trade-opskins-api
[2]: https://github.com/sofwar/trade-opskins-api/tree/master/examples
[3]: https://docs.opskins.com/public/en.html#oauth