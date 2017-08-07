<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 20:48
 */

namespace Core\System;

class Request
{
    static $_instance;
    const TYPE_STRING = 'string';
    const TYPE_INT = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_ARRAY = 'array';

    function __construct()
    {
    }

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    function get($param, $type = 'request', $dataType = 'string')
    {
        if( $dataType === 'integer' )
            $param = (int)$param;

        $type = '_' . strtoupper($type);

        return !empty($GLOBALS[$type][$param]) ? $GLOBALS[$type][$param] : null;
    }

    function set($param, $value = null, $type = 'request')
    {
        $type = '_' . strtoupper($type);

        $GLOBALS[$type][$param] = $value;

        return $GLOBALS[$type][$param];
    }

    function setCookie($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false)
    {
        return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    function getRequestUri()
    {

    }

    static function validation($value, $type)
    {
        if( $type === self::TYPE_STRING )
        {
            if( preg_match("#^[a-zA-Zа-яёЁА-Я0-9-_.]+$#isu", $value) )
                return $value;
        }
        elseif( $type === self::TYPE_FLOAT )
        {
            return (float)$value;
        }
        elseif( $type === self::TYPE_INT )
        {
            return (int)$value;
        }
        elseif( $type === self::TYPE_BOOLEAN )
        {
            if( $value === true )
                return $value;
        }

        return false;
    }

    static function isAjax()
    {
        return self::getInstance()->get('HTTP_X_REQUESTED_WITH', 'server') === 'XMLHttpRequest' ? true : false;
    }

    static function re_die()
    {
        exit();
    }

    static function redirect($location)
    {
        header('Location: ' . $location);

        self::re_die();
    }

    static function e404($title = '404 error', $content = '<p>Not found</p>')
    {
        header("HTTP/1.0 404 Not Found");

        \Core\System\SmartyProcessor::getInstance()->assign([
            'title' => $title,
            'content' => $content,
        ]);

        \Core\System\SmartyProcessor::getInstance()->display('404.tpl');
    }
}