<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/19/17
 * Time: 16:24
 */

namespace Modules\Resume\Model;

use Core\System\SmartyProcessor;
use Modules\Users\Controller\Front\Auth;

class View
{
    function add($module_name)
    {
        if( !empty($_POST) )
            Api::addResumeProcessing();

        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/form.tpl', $module_name);
    }

    function edit($module_name)
    {
        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/form.tpl', $module_name);
    }

    function view($module_name)
    {
        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/list.tpl', $module_name);
    }

    function viewSingle($module_name)
    {
        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/single.tpl', $module_name);
    }
}