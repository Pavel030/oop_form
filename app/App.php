<?php
namespace App;

use App\modules\route\Route;
use App\modules\route\RouteDispathcer;

class App
{

    public static function run(){
        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $methodName = "getRoutes$requestMethod";
        foreach (Route::$methodName() as $routeConfiguration){
            $routeDispacher = new RouteDispathcer($routeConfiguration);
            $routeDispacher->process();
        }
    }
}