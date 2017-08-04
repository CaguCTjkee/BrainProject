<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 16:22
 */

namespace Modules\Main\Controller\Front;

use Core\System\Meta;
use Modules\Main\Controller\Handler;

class Home extends Handler
{
    function displayIndex()
    {
        \Core\System\Meta::getInstance()->setMetaArray();

        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/index.tpl', self::MODULE_NAME);
    }
}