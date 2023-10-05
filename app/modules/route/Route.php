<?php

namespace App\modules\route;

class Route
{
    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }
    /**
     * @return array
     */
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    private static array $routesGet = [];
    private static array $routesPost = [];

    public static function get(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;
        return $routeConfiguration;
    }
    public static function post(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfiguration;
        return $routeConfiguration;
    }
    public static function redirect($url){
        header('Location: ' . $url);
    }
}