<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 16:22
 */

namespace Modules\Admin\Controller\Front;

use Modules\Admin\Controller\Handler;
use Modules\Users\Model\Api;

class Home extends Handler
{
    function displayIndex()
    {
        if( Api::isLogin() )
            \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/index.tpl', self::MODULE_NAME);
        else
        {
            \Core\System\Request::redirect('/auth/login');
        }
    }
}