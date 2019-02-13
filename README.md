# Opskins Trade PHP Library

[![Latest Stable Version](https://poser.pugx.org/sofwar/trade-opskins-api/v/stable)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![Total Downloads](https://poser.pugx.org/sofwar/trade-opskins-api/downloads)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![Latest Unstable Version](https://poser.pugx.org/sofwar/trade-opskins-api/v/unstable)](https://packagist.org/packages/sofwar/trade-opskins-api)
[![License](https://poser.pugx.org/sofwar/trade-opskins-api/license)](https://packagist.org/packages/sofwar/trade-opskins-api)


This is the unofficial client library for the [Opskins Trade API][1]. We provide an intuitive, stable interface to integrate Opskins Trade API into your PHP project.

## Installation

Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md) if you are unfamiliar with Composer or dependency managers in general.

```composer
"require": {
    "sofwar/trade-opskins-api": "0.0.1"
}
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

## API Request
You can find the full list of Opskins Trade API methods [here][1].

### Request sample

##### In the [examples][2] directory


[1]: https://github.com/OPSkins/trade-opskins-api
[2]: https://github.com/sofwar/trade-opskins-api/tree/master/examples