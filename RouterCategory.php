<?php

namespace routing;

use AllowDynamicProperties;
final class RouterCategory
{

    protected string $namespace = '';
    protected GroupCollection $collections;


    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
        $this->collections = new GroupCollection();
    }

    /**
     * @param string $label 分组名称
     * @param string<string> $alias
     * @param callable<callable> $callback
     * @param array<string> $middleware 中间件别名数组
     * @return $this<RouterCategory>
     */
    final public function group(string $label, string $alias, callable $callback, array $middleware = [])
    {
        //TODO
        $this->collections->offsetSet($alias,[
            'label' => $label
        ]);

        $router = new Router();
        $callback($router);
        $router->getAllRoutes();


        return $this;
    }


}
