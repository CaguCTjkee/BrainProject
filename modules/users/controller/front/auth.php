<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:48
 */

namespace Modules\Users\Controller\Front;

use Modules\Users\Controller\Handler;
use Modules\Users\Model\Api;
use Modules\Users\Model\View;

class Auth
{
    private $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex($params = [])
    {
        if( !empty($params['a']) )
        {
            if( method_exists($this, $params['a']) )
                $this->{$params['a']}();
            else
                \Core\System\Request::e404();
        }
    }

    function login()
    {
        $this->view->auth(Handler::MODULE_NAME);
    }

    function register()
    {
        $this->view->register(Handler::MODULE_NAME);
    }

    function logout()
    {
        $request_uri = \Core\System\Request::getInstance()->get('HTTP_REFERER', 'server', \Core\System\Request::TYPE_STRING);
        Api::getInstance()->logout($request_uri);
    }
}