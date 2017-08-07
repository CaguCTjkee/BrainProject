<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 21:22
 */

namespace Modules\Main\Controller;

class Handler
{
    const MODULE_NAME = 'main';

    static function Init($router)
    {
        $router->map('GET', '/', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Home#displayIndex', 'home');
    }
}