<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/16/17
 * Time: 16:10
 */

namespace Core\System;

class Translate
{
    static $LANGUAGE = 'en';
    static $_translate = [];
    static $_langArray = [];

    static function _t($string)
    {
        if( \Core\System\Setup::$LANGUAGE !== 'en' )
        {
            $langFilePath = ROOT . DS . 'language' . DS . \Core\System\Setup::$LANGUAGE . '.php';
            if( is_file($langFilePath) && count(self::$_langArray) === 0 )
            {
                self::$_langArray = require_once $langFilePath;
            }

            $string = strtr($string, self::$_langArray);
        }

        return $string;
    }
}