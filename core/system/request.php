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