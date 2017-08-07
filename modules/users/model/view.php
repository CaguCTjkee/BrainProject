<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/19/17
 * Time: 16:24
 */

namespace Modules\Users\Model;

use Core\System\SmartyProcessor;
use Modules\Users\Controller\Front\Auth;

/**
 * Class View - for view templates
 * @package Modules\Users\Model
 *
 */
class View
{
    function unAuth($module_name)
    {
        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/unAuth.tpl', $module_name);
    }

    function auth($module_name)
    {
        if( User::$is_login )
        {
            SmartyProcessor::getInstance()->assign('error', 'User already login');
        }
        else
        {
            $request_uri = \Core\System\Request::getInstance()->get('HTTP_REFERER', 'server', \Core\System\Request::TYPE_STRING);
            Api::authProcessing($request_uri);
        }
        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/auth.tpl', $module_name);
    }

    function register($module_name)
    {
        if( count($_POST) > 0 && User::$is_login === false )
            Api::registerProcessing();

        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/register.tpl', $module_name);
    }
}