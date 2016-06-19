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
