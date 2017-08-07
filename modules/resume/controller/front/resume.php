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
use Core\System\Request;
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
                    $params['b'] = !empty($params['b']) ? $params['b'] : null;
                    $this->{$params['a']}($params['b']);
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
        $assign = DB::get(\Modules\Users\Model\Api::DB_TABLE_USERS_INFO, 'user_id = ?', [User::getInstance()->getUserId()]);
        SmartyProcessor::getInstance()->assign($assign->fetch(\PDO::FETCH_ASSOC));

        // categories
        $categories = DB::getRows(Api::DB_TABLE_RESUME_CATEGORY);
        SmartyProcessor::getInstance()->assign([
            'categories' => $categories,
        ]);

        $this->view->add(Handler::MODULE_NAME);
    }

    function edit($id)
    {
        if( !empty($id) )
        {
            $user_id = User::getInstance()->getUserId();
            $resume = DB::getRow(Api::DB_TABLE_RESUME, 'user_id = ? AND resume_id = ?', [$user_id, $id]);

            if( $resume )
            {
                if( $_POST )
                {
                    Api::addResumeProcessing($resume['resume_id']);
                    $resume = DB::getRow(Api::DB_TABLE_RESUME, 'user_id = ? AND resume_id = ?', [$user_id, $id]);
                }

                $meta = [
                    'title' => 'Редактирование резюме ' . $resume['position'],
                    'description' => 'Редактирование резюме на сайте ' . Setup::$SITEURL,
                ];
                Meta::getInstance()->setMetaArray($meta);

                $categories = DB::getRows(Api::DB_TABLE_RESUME_CATEGORY);
                $user_info = DB::getRow(\Modules\Users\Model\Api::DB_TABLE_USERS_INFO, 'user_id = ?', [User::getInstance()->getUserId()]);
                $education = DB::getRows(Api::DB_TABLE_RESUME_EDUCATION, 'resume_id = ?', [$resume['resume_id']]);
                $experience = DB::getRows(Api::DB_TABLE_RESUME_EXPERIENCE, 'resume_id = ?', [$resume['resume_id']]);

                $assign = [
                    'resume' => $resume,
                    'user_info' => $user_info,
                    'education' => $education,
                    'experience' => $experience,
                    'categories' => $categories,
                ];
                SmartyProcessor::getInstance()->assign($assign);

                $this->view->edit(Handler::MODULE_NAME);

            }
            else
                \Core\System\Request::e404();
        }
        else
            \Core\System\Request::e404();
    }

    function view($id)
    {
        if( empty($id) )
        {
            $meta = [
                'title' => 'Ваши резюме',
                'description' => 'Список резюме на сайте ' . Setup::$SITEURL,
            ];
            Meta::getInstance()->setMetaArray($meta);

            $list = DB::getRows(Api::DB_TABLE_RESUME, 'user_id = ?', [User::getInstance()->getUserId()]);
            SmartyProcessor::getInstance()->assign('list', $list);

            $this->view->view(Handler::MODULE_NAME);
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

    function delete($id)
    {
        $resume = DB::getRow(Api::DB_TABLE_RESUME, 'user_id = ? AND resume_id = ?', [User::getInstance()->getUserId(), $id]);
        if( $resume )
        {
            Api::deleteResume($resume['resume_id']);
            Request::redirect('/resume/view');
        }
        else
            \Core\System\Request::e404('Resume not found');
    }
}