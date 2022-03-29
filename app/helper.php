<?php
if(!function_exists('eur')) {
    function eur($value) {
        return number_format($value, 2, ',', ' ')." €";
    }
}

if (!function_exists('currentRouteActiveFront')) {
    function currentRouteActiveFront(...$routes)
    {
        foreach ($routes as $route) {
            if(Route::currentRouteName() === $route) return 'here show';
        }
    }
}

if (!function_exists('randColor')) {
    function randColor()
    {
        $color = [
            "primary",
            "secondary",
            "white",
            "light",
            "success",
            "info",
            "warning",
            "danger",
            "dark"
        ];

        return $color[rand(0,8)];
    }
}

if (!function_exists('decRound')) {
    function decRoud(...$routes)
    {
        foreach ($routes as $route) {
            if(Route::currentRouteName() === $route) return 'here show';
        }
    }
}

if (!function_exists('clear')) {
    function clear()
    {
        system('rm -rf /storage/app/public/gdd');
        system('rm -rf /storage/logs');
    }
}

if (!function_exists('randomString')) {
    function randomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('ismobile')) {
    function ismobile()
    {
        if(request()->user()->devices()->latest()->first()->is_mobile == 1) {
            return true;
        } else {
            return false;
        }
    }
}
