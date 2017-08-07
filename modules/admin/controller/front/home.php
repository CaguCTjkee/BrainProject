<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 16:22
 */

namespace Modules\Admin\Controller\Front;

use Modules\Admin\Controller\Handler;

class Home extends Handler
{
    function displayIndex()
    {

        if( \Modules\Admin\Model\Api::checkAccess() )
            \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/index.tpl', self::MODULE_NAME);
    }
}