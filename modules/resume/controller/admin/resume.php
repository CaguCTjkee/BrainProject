<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:48
 */

namespace Modules\Resume\Controller\Admin;

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

    function addCategory()
    {
        $meta = [
            'title' => 'Добавить категорию',
            'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
        ];
        Meta::getInstance()->setMetaArray($meta);

        SmartyProcessor::getInstance()->moduleDisplay('admin/category-form.tpl', \Modules\Resume\Controller\Handler::MODULE_NAME);
    }

    function editCategory($id)
    {

        $category = DB::getRow(Api::DB_TABLE_RESUME_CATEGORY, 'category_id = ?', [$id]);

        if( $category )
        {
            $meta = [
                'title' => 'Редактировать категорию' . $category['name'],
                'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
            ];
            Meta::getInstance()->setMetaArray($meta);

            SmartyProcessor::getInstance()->assign('category', $category);
            SmartyProcessor::getInstance()->moduleDisplay('admin/category-form.tpl', \Modules\Resume\Controller\Handler::MODULE_NAME);
        }
        else
            \Core\System\Request::e404('Category not found');
    }

    function category($id)
    {
        if( empty($id) )
        {
            $meta = [
                'title' => 'Категории',
                'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
            ];
            Meta::getInstance()->setMetaArray($meta);

            $list = DB::getRows(Api::DB_TABLE_RESUME_CATEGORY);
            SmartyProcessor::getInstance()->assign('list', $list);

            SmartyProcessor::getInstance()->moduleDisplay('admin/category-list.tpl', \Modules\Resume\Controller\Handler::MODULE_NAME);
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

            $list = DB::getRows(Api::DB_TABLE_RESUME);
            SmartyProcessor::getInstance()->assign('list', $list);

            SmartyProcessor::getInstance()->moduleDisplay('admin/list.tpl', \Modules\Resume\Controller\Handler::MODULE_NAME);
        }
        else
        {
            $user_id = User::getInstance()->getUserId();
            $resume = DB::getRow(Api::DB_TABLE_RESUME, 'user_id = ? AND resume_id = ?', [$user_id, $id]);

            if( $resume )
            {
                $meta = [
                    'title' => 'Резюме ' . $resume['position'],
                    'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
                ];
                Meta::getInstance()->setMetaArray($meta);

                $user_info = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS_INFO, 'user_id = ?', [User::getInstance()->getUserId()]);
                $education = DB::getRows(Api::DB_TABLE_RESUME_EDUCATION, 'resume_id = ?', [$resume['resume_id']]);
                $experience = DB::getRows(Api::DB_TABLE_RESUME_EXPERIENCE, 'resume_id = ?', [$resume['resume_id']]);

                $assign = [
                    'resume' => $resume,
                    'user_info' => $user_info,
                    'education' => $education,
                    'experience' => $experience,
                ];
                SmartyProcessor::getInstance()->assign($assign);

                $this->view->viewSingle(Handler::MODULE_NAME);
            }
            else
                \Core\System\Request::e404();
        }
    }
}