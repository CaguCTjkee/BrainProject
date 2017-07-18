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

    function __construct()
    {
    }

    function showDetails()
    {
        echo ';;123123213';
    }

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    function get($param, $type = 'request')
    {
        $type = '_' . strtoupper($type);

        return !empty($$type[$param]) ? $$type[$param] : null;
    }

    function set($param, $value = null, $type = 'request')
    {
        $type = '_' . strtoupper($type);

        $$type[$param] = $value;

        return $$type[$param];
    }

    static function isAjax()
    {
        return self::getInstance()->get('HTTP_X_REQUESTED_WITH', 'server') === 'XMLHttpRequest' ? true : false;
    }

    static function re_die()
    {
        die();
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