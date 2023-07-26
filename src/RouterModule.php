<?php

namespace Createlinux\Routing;

final class RouterModule
{

    protected string $moduleDirName = '';
    protected Collection $routerCollection;


    public function __construct(string $moduleDirName = '')
    {
        $this->moduleDirName = $moduleDirName;
        $this->routerCollection = new Collection();
    }

    /**
     * @param string $resourceLabel 资源名称
     * @param string<string> $resourceAlias 资源别名
     * @param callable<callable> $packCallback
     * @param array<string> $middleware 中间件别名数组
     * @return $this<RouterModule>
     */
    final public function registerResource(string $resourceLabel, string $resourceAlias, array $middleware = [], callable|null $packCallback = null)
    {
        //TODO
        /*$this->routerCollection->offsetSet($resourceAlias, [
            'label' => $resourceLabel
        ]);*/

        //检测$packCallback参数
        if($packCallback){
            $router = new Router($this->moduleDirName);
            $packCallback($router);

            $router->getAll()->map(function(RouterItem $routerItem){
                $this->routerCollection->offsetSet($routerItem->getAliasName(),$routerItem);
            });

        }


        return $this;
    }

    public function getAllRouters()
    {
        return $this->routerCollection;
    }


}
