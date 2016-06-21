# onesignal-laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A service provider for Onesignal API in Laravel 5 

## Install

Via Composer

``` bash
$ composer require greedchikara/onesignal dev-master
```
or append your composer.json with:

``` json
"require": {
    "greedchikara/onesignal": "dev-master"
},
```

Add the following settings to the config/app.php

Update **Service Provider**

``` php
'providers' => [
    ...
    'greedchikara\Onesignal\OnesignalServiceProvider',
]
```

Update **Facade**

``` php
'aliases' => [
    ...
    'Onesignal' => 'greedchikara\Onesignal\Facades\Onesignal',
]
```

## Configuration

``` bash
 php artisan vendor:publish --provider="greedchikara\Onesignal\OneSignalServiceProvider"
```
It will create **onesignal.php** within the **config directory**.

``` php
<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | OneSignal User Auth Key
    |--------------------------------------------------------------------------
    |
    | This value is used for making api call to onesignal server.
    | This is a compuslory value for making onesignal api calls.
    | Set this in your ".env" file.
    | Api's which utilizes this key
    |  - Server REST API - GET /apps (View Apps)
    |  - Server REST API - GET /apps/:id (View an app)
    |
    */
   
    'user_auth_key'  => env('ONESIGNAL_USER_AUTH_KEY'),

    /*
    |--------------------------------------------------------------------------
    | OneSignal First App
    |--------------------------------------------------------------------------
    |
    | Default name of first app
    | Do not change the key, however you can change the value.
    | But if you decide to change the value do update the procedding key.
    |
    */
    'first_app_name' => 'one_signal_mobile_push',

    // Config of the first App
    'one_signal_mobile_push' => [

        /*
        |--------------------------------------------------------------------------
        | One Signal App Id
        |--------------------------------------------------------------------------
        |
        | This value is used for making api call to one signal server.
        | This is a compuslory value for making onesignal api calls.
        | Set this in your ".env" file.
        |
        */
       
        'app_id' => env('FIRST_APP_ONESIGNAL_APP_ID'),

        /*
        |--------------------------------------------------------------------------
        | One Signal REST API Key
        |--------------------------------------------------------------------------
        |
        | This value is used for making api call to one signal server.
        | This is a compuslory value for making onesignal api calls.
        | Set this in your ".env" file.
        |
        */
        
        'rest_api_key' => env('FIRST_APP_ONESIGNAL_REST_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | OneSignal API Links
    |--------------------------------------------------------------------------
    |
    | Only update if Onesignal Updates it's API URL
    |
    */
    'view_apps'          => 'https://onesignal.com/api/v1/apps',
 
    'view_devices'       => 'https://onesignal.com/api/v1/players',

    'view_notifications' => 'https://onesignal.com/api/v1/notifications',

];
```
## Usage

``` php
use Onesignal;
Onesignal::viewApps();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Todo

* Better documentation - in progress as you can see :)
* Implementing the rest of the API. :)


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email negiakash@gmail.com instead of using the issue tracker.

## Credits

- [shanky][greedchikara]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/greedchikara/onesignal-laravel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/greedchikara/onesignal-laravel/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/greedchikara/onesignal-laravel.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/greedchikara/onesignal-laravel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/greedchikara/onesignal-laravel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/greedchikara/onesignal-laravel
[link-travis]: https://travis-ci.org/greedchikara/onesignal-laravel
[link-scrutinizer]: https://scrutinizer-ci.com/g/greedchikara/onesignal-laravel/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/greedchikara/onesignal-laravel
[link-downloads]: https://packagist.org/packages/greedchikara/onesignal-laravel
[greedchikara]: https://github.com/greedchikara
[link-contributors]: ../../contributors
