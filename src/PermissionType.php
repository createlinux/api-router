<?php

namespace Createlinux\Routing;

enum PermissionType: string
{
    //无需登录
    case public = 'public';
    //根据角色判断
    case role = 'role';

    case login = 'login';

    case private = 'private';
}