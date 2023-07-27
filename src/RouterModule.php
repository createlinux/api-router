<?php

namespace Createlinux\Routing;

final class RouterModule
{

    protected string $moduleDirName = '';
    protected Collection $resourceCollection;
    protected Collection $routerItemCollection;

    /**
     * @var Collection|array
     */
    //protected Collection|null $moduleCollection = null;


    public function __construct(string $moduleDirName = '')
    {
        $this->moduleDirName = $moduleDirName;
        $this->resourceCollection = new Collection();
        $this->routerItemCollection = new Collection();
        //$this->moduleCollection[$this->moduleDirName] = new Collection();
    }

    /**
     * @param string $resourceLabel 资源名称
     * @param string<string> $resourceAlias 资源别名
     * @param callable<callable> $packCallback
     * @param array<string> $middlewares 中间件别名数组
     * @return $this<RouterModule>
     */
    final public function registerResource(string $resourceLabel, string $resourceAlias, array $middlewares = [], callable|null $packCallback = null)
    {
        $resource = new Resource($resourceLabel, $resourceAlias, $this->moduleDirName, $middlewares);
        $this->resourceCollection->offsetSet($resourceAlias, $resource);

        //检测$packCallback参数
        if ($packCallback) {
            $router = new Router($this->moduleDirName);
            $packCallback($router);

            $router->getAll()->map(function (RouterItem $routerItem) use ($resource) {
                $resource->getRouteItems()?->offsetSet($routerItem->getAliasName(), $routerItem);
                $this->routerItemCollection->offsetSet($routerItem->getAliasName(), $routerItem);
            });

        }


        return $this;
    }

    public function getAllRoutersGroupByResource()
    {
        return $this->resourceCollection;
    }

    public function getAllRouters()
    {
        return $this->routerItemCollection;
    }


}
