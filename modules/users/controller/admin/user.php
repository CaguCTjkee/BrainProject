<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 8/7/17
 * Time: 11:11
 */

namespace modules\users\controller\admin;

use Core\System\DB;
use Core\System\Meta;
use Core\System\Request;
use Core\System\Setup;
use Core\System\SmartyProcessor;

class User
{
    function actionIndex($params = [])
    {
        if( \Modules\Admin\Model\Api::checkAccess() )
        {
            if( !empty($params['a']) )
            {
                if( method_exists($this, $params['a']) )
                {
                    if( \Modules\Users\Model\User::$is_login )
                    {
                        $params['b'] = !empty($params['b']) ? $params['b'] : null;
                        $this->{$params['a']}($params['b']);
                    }
                    else
                    {
                        $this->view->unAuth(Handler::MODULE_NAME);
                    }
                }
                else
                    \Core\System\Request::e404('Not found module');
            }
        }
    }
    function delete($id)
    {
        $user = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS, 'user_id = ?', [$id]);
        if( $user )
        {
            \Modules\Users\Model\Api::getInstance()->deleteUser($user['user_id']);
            \Core\System\Request::redirect('/admin/user/edit');

        }
    }

    function edit($id)
    {
        if( empty($id) )
        {
            $meta = [
                'title' => 'Ваши резюме',
                'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
            ];
            Meta::getInstance()->setMetaArray($meta);

            $list = DB::getRows(\Modules\Users\Model\Api::DB_TABLE_USERS);
            SmartyProcessor::getInstance()->assign('list', $list);

            SmartyProcessor::getInstance()->moduleDisplay('admin/list.tpl', \Modules\Users\Controller\Handler::MODULE_NAME);
        }
        else
        {
            $user = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS, 'user_id = ?', [$id]);

            if( $user )
            {
                if( $_POST )
                {
                    \Modules\Users\Model\Api::userEditProcessing($user['user_id']);
                    $user = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS, 'user_id = ?', [$user['user_id']]);
                }

                $meta = [
                    'title' => 'Пользователь ' . $user['login'],
                    'description' => 'Редактирование пользователей ' . Setup::$SITEURL,
                ];
                Meta::getInstance()->setMetaArray($meta);

                $user_info = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS_INFO, 'user_id = ?', [$id]);

                $assign = [
                    'user' => $user,
                    'user_info' => $user_info,
                ];
                SmartyProcessor::getInstance()->assign($assign);

                SmartyProcessor::getInstance()->moduleDisplay('admin/user.tpl', \Modules\Users\Controller\Handler::MODULE_NAME);
            }
            else
                \Core\System\Request::e404();
        }
    }
}