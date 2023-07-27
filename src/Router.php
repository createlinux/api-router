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

    public function __construct(string $categoryAlias)
    {
        $this->categoryAlias = $categoryAlias;
        $this->routerCollection = new Collection();
    }

    public function setControllerName(string $controllerName)
    {
        if(!trim($controllerName)){
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

    public function show(string $businessName, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "show")
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessName, $uri, $methodName, "GET", $permissionType);
    }

    /**
     * @param string $businessName
     * @param string $uri
     * @param string $methodName
     * @param array $permission
     * @return void
     */
    public function store(string $businessName, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "store")
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessName, $uri, $methodName, "POST", $permissionType);
    }

    public function destroy(string $businessName, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "destroy")
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessName, $uri, $methodName, "DELETE", $permissionType);
    }

    public function update(string $businessName, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "update")
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessName, $uri, $methodName, "UPDATE", $permissionType);
    }

    public function patch(string $businessName, string $uri, PermissionType $permissionType = PermissionType::role, string $methodName = "patch")
    {
        $aliasName = $this->packAliasName($methodName);
        $this->pushRouteItem($aliasName, $businessName, $uri, $methodName, "PATCH", $permissionType);
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
     * @param string $businessName
     * @param string $uri
     * @param string $methodName
     * @param PermissionType $permissionType
     * @return void
     */
    protected function pushRouteItem(
        string         $aliasName,
        string         $businessName,
        string         $uri,
        string         $methodName,
        string         $requestMethod,
        PermissionType $permissionType,
    ): void
    {
        $this->routerCollection->offsetSet(
            $aliasName,
            new RouterItem($this->categoryAlias, $businessName, $aliasName, $uri, $this->className, $methodName, $requestMethod, $permissionType),
        );
    }


}