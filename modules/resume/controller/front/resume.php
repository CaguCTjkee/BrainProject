<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:48
 */

namespace Modules\Resume\Controller\Front;

use Core\System\DB;
use Core\System\Meta;
use Core\System\Setup;
use Core\System\SmartyProcessor;
use Modules\Resume\Controller\Handler;
use Modules\Resume\Model\Api;
use Modules\Resume\Model\View;
use Modules\Users\Model\User;

class Resume
{
    private $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex($params = [])
    {
        if( !empty($params['a']) )
        {
            if( method_exists($this, $params['a']) )
            {
                if( User::$is_login )
                {
                    $this->{$params['a']}();
                }
                else
                {
                    $this->view->unAuth(Handler::MODULE_NAME);
                }
            }
            else
                \Core\System\Request::e404();
        }
    }

    function add()
    {
        $meta = [
            'title' => 'Добавить резюме',
            'description' => 'Добавить резюме на сайте ' . Setup::$SITEURL,
        ];
        Meta::getInstance()->setMetaArray($meta);

        // user_info
        $assign = DB::get(\Modules\Users\Model\Api::DB_TABLE_USERS_INFO, 'user_id = ?', [\Modules\Users\Model\User::getInstance()->getUserId()]);
        SmartyProcessor::getInstance()->assign($assign->fetch(\PDO::FETCH_ASSOC));

        // categories
        $categories = DB::getRows(Api::DB_TABLE_RESUME_CATEGORY);
        SmartyProcessor::getInstance()->assign([
            'categories' => $categories,
        ]);

        $this->view->add(Handler::MODULE_NAME);
    }

    function view()
    {
        $meta = [
            'title' => 'Ваши резюме',
            'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
        ];
        Meta::getInstance()->setMetaArray($meta);

        $this->view->view(Handler::MODULE_NAME);
    }
}