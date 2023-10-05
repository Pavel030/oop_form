<?php

namespace App\modules\route;

class RouteDispathcer
{
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $paramRequestMap = [];
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {
        /**
         * Если строка запроса есть, сохраняем и чистим ее от слешей.
         */
        $this->saveRequestUri();
        /**
         * Разбиваю строку рута на массив и кладу в новый массив имя аргумента и позицию в массиве.
         */
        $this->setParamMap();
        /**
         * Разбиваю строку запроса.
         */
        $this->makeRegexRequest();
        $this->run();

    }

    private function saveRequestUri()
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }
    }

    private function clean($str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    private function setParamMap()
    {
        $routeArray = explode('/', $this->routeConfiguration->route);
        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            };
        }
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);
        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        };
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex()
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run()
    {
        if (preg_match("/$this->requestUri/", $this->routeConfiguration->route)) {
            $this->render();
        }
    }

    public function render()
    {
        $className = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print((new $className)->$action(...$this->paramRequestMap));
        die();
    }

}