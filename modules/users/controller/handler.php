<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 21:22
 */

namespace Modules\Users\Controller;

class Handler
{
    const MODULE_NAME = 'users';

    static function Init($router)
    {
        $router->map('GET', '/auth/[a:a]', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Auth#actionIndex', self::MODULE_NAME);
    }
}