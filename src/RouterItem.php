<?php

namespace Createlinux\Routing;

/**
 * 路由项
 */
final class RouterItem
{

    protected string $businessName = '';
    protected string $aliasName = '';
    protected PermissionType|string $permissionType = '';
    protected string $requestMethod = 'GET';
    protected string $uri = '';
    protected string $categoryAlias;
    protected string $className;
    protected string $methodName = '';

    /**
     * @param string $businessName 业务名称
     * @param string $aliasName 别名
     * @param string $uri 路由
     * @param string $methodName 方法名称
     * @param PermissionType $permissionType 权限类型
     */
    public function __construct(
        string         $categoryAlias,
        string         $businessName,
        string         $aliasName,
        string         $uri,
        string         $className,
        string         $methodName,
        string         $requestMethod,
        PermissionType $permissionType,
    )
    {
        $this->className = $className;
        $this->methodName = $methodName;
        $this->permissionType = $permissionType;
        $this->categoryAlias = $categoryAlias;
        $this->businessName = $businessName;
        $this->aliasName = $aliasName;
        $this->requestMethod = strtoupper($requestMethod);
        $this->uri = "/" . ltrim($uri, "/");
    }

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function getAliasName(): string
    {
        return $this->aliasName;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * 获取请求方法
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getPermissionType(): PermissionType|string
    {
        return $this->permissionType;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }
}