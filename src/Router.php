<?php

namespace Createlinux\Routing;

class Router
{

    protected string $label = '';
    protected string $controllerName = '';
    protected string $className = '';
    protected string $methodName = '';

    protected Collection $routerCollection;
    protected string $categoryAlias = '';
    private Resource $resource;

    public function __construct(string $categoryAlias, Resource $resource)
    {
        $this->categoryAlias = $categoryAlias;
        $this->routerCollection = new Collection();
        $this->resource = $resource;
    }

    public function setControllerName(string $controllerName)
    {
        if (!trim($controllerName)) {
            throw new \InvalidArgumentException("控制器名称不能为空");
        }
        $this->className = $controllerName;
        $this->controllerName = basename($controllerName);
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getClassName()
    {
        return $this->className;
    }

    /**
     * 获取路由别名
     */

    public function show(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "show", array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "GET", $permissionType, $middlewares);
    }

    public function index(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = 'index', array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "GET", $permissionType, $middlewares);
    }

    /**
     * @param string $businessLabel
     * @param string $uri
     * @param string $methodName
     * @param array $permission
     * @return void
     */
    public function store(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "store", array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "POST", $permissionType, $middlewares);
    }

    public function destroy(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "destroy", array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "DELETE", $permissionType, $middlewares);
    }

    public function update(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "update", array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "UPDATE", $permissionType, $middlewares);
    }

    public function patch(string $businessLabel, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "patch", array $middlewares = [])
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessLabel, $uri, $methodName, "PATCH", $permissionType, $middlewares);
    }

    public function getAll(): Collection
    {
        return $this->routerCollection;
    }

    //注册自定义请求方法
    public function custom(string $requestMethod, string $label, string $uri, string $methodName, PermissionType $permissionType)
    {

    }

    /**
     * @param string $methodName
     * @return string
     */
    protected function packAliasName(string $methodName): string
    {
        $categoryAlias = $this->categoryAlias ? "{$this->categoryAlias}." : "";
        return "{$categoryAlias}{$this->getControllerName()}.{$methodName}";
    }

    /**
     * @param string $aliasName
     * @param string $businessLabel
     * @param string $uri
     * @param string $methodName
     * @param PermissionType $permissionType
     * @return void
     */
    protected function pushRouteItem(
        string         $aliasName,
        string         $businessLabel,
        string         $uri,
        string         $methodName,
        string         $requestMethod,
        PermissionType $permissionType,
        array          $middlewares = []
    ): void
    {
        $this->routerCollection->offsetSet(
            $aliasName,
            new RouterItem(
                $this->categoryAlias,
                $businessLabel,
                $aliasName,
                $uri,
                $this->className,
                $methodName,
                $requestMethod,
                $permissionType,
                array_merge($this->getResource()->getMiddlewares(), $middlewares)
            ),
        );
    }

    public function getResource(): Resource
    {
        return $this->resource;
    }


}