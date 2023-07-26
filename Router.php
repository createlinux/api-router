<?php

namespace routing;

use AllowDynamicProperties;

class Router
{

    protected string $label = '';
    protected string $controllerName = '';
    protected string $methodName = '';

    public function __construct()
    {

    }

    public function setController(string $controllerName)
    {
        $this->controllerName = $controllerName;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setMethodName(string $methodName)
    {
        $this->methodName = $methodName;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     * 获取路由别名
     */
    public function getAlias()
    {
        //命名空间名称、分类名、控制器名、方法名
    }

    public function get(string $uri)
    {

    }

    public function post(string $uri)
    {

    }

    public function delete(string $uri)
    {

    }

    public function put(string $uri)
    {

    }

    public function patch(string $uri)
    {

    }

    public function getAllRoutes(): array
    {

    }


}