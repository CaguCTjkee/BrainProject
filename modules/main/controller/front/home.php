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
        $stmt = DB::run("SELECT * FROM test");
        while( $row = $stmt->fetch(\PDO::FETCH_LAZY) )
        {
            echo $row->name . ' - ' . $row->value . EL;
        }

        die();

        \Core\System\SmartyProcessor::getInstance()->moduleDisplay('front/index.tpl', self::MODULE_NAME);
    }
}