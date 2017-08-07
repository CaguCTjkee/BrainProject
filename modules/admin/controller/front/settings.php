<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 8/7/17
 * Time: 10:45
 */

namespace Modules\Admin\Controller\Front;

use Modules\Admin\Controller\Handler;
use Modules\Admin\Model\Api;

class Settings extends Handler
{
    function displayIndex()
    {
        if( \Modules\Admin\Model\Api::checkAccess() )
        {
            if( !empty($_POST) )
                Api::saveSettingsProcessing();

            $assign = [
                'settings' => \Core\System\Setup::$_config,
            ];

            \Core\System\SmartyProcessor::getInstance()->assign($assign);
            \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/settings.tpl', self::MODULE_NAME);
        }
    }
}