<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/21/17
 * Time: 13:04
 */

namespace Modules\Users\Controller\Front;

use Core\System\DB;
use Core\System\Meta;
use Core\System\SmartyProcessor;
use Modules\Users\Controller\Handler;
use Modules\Users\Model\Api;
use Modules\Users\Model\User;
use Modules\Users\Model\View;

class Cabinet
{
    private $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex()
    {
        if( User::$is_login )
        {
            $meta = [
                'title' => 'Личный кабинет',
            ];
            Meta::getInstance()->setMetaArray($meta);

            $user_id = User::getInstance()->getUserId();

            if( !empty($_POST) )
                Api::cabinetProcessing($user_id);

            $assign = DB::get(Api::DB_TABLE_USERS_INFO, 'user_id = ?', [$user_id]);
            SmartyProcessor::getInstance()->assign($assign->fetch(\PDO::FETCH_ASSOC));
            SmartyProcessor::getInstance()->moduleDisplay('front/cabinet.tpl', Handler::MODULE_NAME);
        }
        else
        {
            $this->view->unAuth(Handler::MODULE_NAME);
        }
    }
}