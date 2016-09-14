<?php 

if (! function_exists('app_asset')) {
    function app_asset($path)
    {
        return app('url')->asset($path, env('APP_SSL_ASSETS', false));
    }
}
