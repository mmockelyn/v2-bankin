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
