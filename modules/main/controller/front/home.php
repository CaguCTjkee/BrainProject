<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 16:22
 */

namespace Modules\Main\Controller\Front;

use Modules\Main\Controller\Handler;
use Core\System\DB as DB;

class Home extends Handler
{
    function displayIndex()
    {
        \Modules\Users\Controller\Handler::install();
        die();

        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/index.tpl', self::MODULE_NAME);
    }
}