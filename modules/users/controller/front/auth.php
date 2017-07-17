<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:48
 */

namespace Modules\Users\Controller\Front;

use Modules\Users\Model\Api;

class Auth
{
    private $api;

    function __construct()
    {
        $this->api = new Api();
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

    function logout()
    {
        $this->api->logout();
    }
}