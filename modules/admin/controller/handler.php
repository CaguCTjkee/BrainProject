<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 21:22
 */

namespace Modules\Admin\Controller;

class Handler
{
    const MODULE_NAME = 'admin';

    static function Init($router)
    {
        $router->map('GET|POST', '/admin', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Home#displayIndex', 'admin');
        $router->map('GET|POST', '/admin/settings', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Settings#displayIndex', 'admin-settings');
    }
}