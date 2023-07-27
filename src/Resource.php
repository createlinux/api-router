<?php

namespace Createlinux\Routing;

final class Resource
{
    protected string $resourceName = '';
    protected string $resourceAlias = '';
    protected array $middlewares = [];
    protected string $moduleDirName = '';

    protected Collection|null $routeItems = null;

    final public function __construct(string $resourceName, string $resourceAlias, string $moduleDirName, array $middlewares = [])
    {
        if (!$resourceName) {
            throw new \InvalidArgumentException('$resourceName不能为空');
        }
        if (!$resourceAlias) {
            throw new \InvalidArgumentException('$resourceAlias不能为空');
        }
        if (!$moduleDirName) {
            throw new \InvalidArgumentException('$moduleDirName不能为空');
        }
        $this->resourceName = $resourceName;
        $this->resourceAlias = $resourceAlias;
        $this->moduleDirName = $moduleDirName;
        $this->middlewares = $middlewares;
        $this->routeItems = new Collection();
    }

    public function getRouteItems()
    {
        return $this->routeItems;
    }
}