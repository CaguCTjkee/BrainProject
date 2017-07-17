<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 12:28
 */

namespace Core\System;

class FrontController
{
    public $router;

    function __construct()
    {
        new \Core\System\SmartyProcessor();

        $this->Init();
    }

    function Init()
    {
        // Mapping Routes
        $this->router = new AltoRouter();

        // get all modules router
        $this->getModulesRouters();

        // match
        $match = $this->router->match();

        // do we have a match?
        if( $match )
        {
            $target = explode('#', $match['target']);
            $controller = new $target[0];
            $controller->{$target[1]}();
        }
        else
        {
            \Core\System\Request::e404();
        }
    }

    function getModulesRouters()
    {
        foreach( glob(MODULES . DS . '*') as $module )
        {
            $module = '\Modules\\' . pathinfo($module, PATHINFO_FILENAME) . '\Controller\Handler::Init';
            call_user_func_array($module, [$this->router]);
        }
    }
}