<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/21/17
 * Time: 13:04
 */

namespace Modules\Users\Controller\Front;

use Core\System\Request;
use Core\System\Setup;
use Core\System\Translate;
use Modules\Users\Model\User;

class Upload
{
    public $ext = ['png', 'jpg', 'gif', 'jpeg'];
    private $uploadDir = 'upload';

    function actionIndex()
    {
        $data = ['error' => ''];

        if( Request::isAjax() )
        {
            if( $_FILES && User::$is_login )
            {
                // upload
                $data['files'] = $_FILES;
                $file = $_FILES['file'];
                $filePathinfo = pathinfo($file['name']);

                if( in_array(strtolower($filePathinfo['extension']), $this->ext) === false )
                    $data['error'] = Translate::_t('Unexpected format of file');

                if( filesize($file['tmp_name']) > Setup::$_config['avatar_size'] * 1024 * 1024 )
                    $data['error'] = Translate::_t('File is too large');

                if( empty($data['error']) )
                {
                    $newFileName = User::getInstance()->getUserId() . '-' . Translate::russToLat($file['name']);
                    $uploadFile = ROOT . DS . $this->uploadDir . DS . $newFileName;

                    if( move_uploaded_file($file['tmp_name'], $uploadFile) )
                    {
                        // send url
                        $data['success'] = Setup::$HOME . '/' . $this->uploadDir . '/' . $newFileName;
                    }
                    else
                    {
                        $data['error'] = Translate::_t('Something wrong');
                    }
                }
            }
            else
                $data['error'] = Translate::_t('$_FILES empty or you did not login');
        }
        else
            $data['error'] = Translate::_t('Is not ajax');

        echo json_encode($data);
    }
}