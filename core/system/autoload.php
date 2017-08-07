<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 12:30
 */

namespace Core\System;

/**
 * Class Autoload
 * @package Core\System
 */
class Autoload
{
    const EXT = '.php';

    function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    /**
     * @param $class_name
     */
    function autoload($class_name)
    {
        $class_name = strtolower(strtr($class_name, ['\\' => DS]));

        if( is_file(ROOT . DS . $class_name . self::EXT) )
            include_once ROOT . DS . $class_name . self::EXT;
    }
}

new Autoload();