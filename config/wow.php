<?php

return [

    /*
    |--------------------------------------------------------------------------
    | BattleNet Token
    |--------------------------------------------------------------------------
    |
    | This is the public key provided by BattleNet to access their API, if
    | you don't have a key, one can be generated from the link below.
    |
    |   https://dev.battle.net/apps/myapps
    |
    */

    'token' => env('BATTLENET_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | API Region
    |--------------------------------------------------------------------------
    |
    | This will determine what API endpoint that is going to be hit when 
    | retrieving data from the BattleNet API, available options are:
    |
    |   EU, US, KR, TW
    |
    | The appropriate local value will be used depending on what region is
    | used for the request.
    |
    */

    'region' => 'EU',

    /*
    |--------------------------------------------------------------------------
    | API Update rate
    |--------------------------------------------------------------------------
    |
    | This is the list of characters that should be fetched from the BattleNet
    | API, the key should be the realm of the character, and the vaoue is
    | is the character name itself.
    |
    */
   
   'update-rate' => 125
];
