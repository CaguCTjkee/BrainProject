<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 8/7/17
 * Time: 10:49
 */

namespace Modules\Admin\Model;

class Api
{
    const CONFIG_FILE_NAME = 'config.auto.php';
    protected static $_instance;

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * Check access to /admin page
     * @return bool
     */
    static function checkAccess()
    {
        if( \Modules\Users\Model\Api::isLogin() )
        {
            if( (int)\Modules\Users\Model\User::getInstance()->getisAdmin() === 1 )
                return true;
            else
                \Core\System\Request::e404('Access declined', 'You don\'t have access to this page');
        }
        else
        {
            \Core\System\Request::redirect('/auth/login');
        }
    }

    /**
     * Start process save settings on /admin/setting page
     */
    static function saveSettingsProcessing()
    {
        $settings = '<?php' . EL . '$_config = ';
        $settings .= var_export($_POST, true);
        $settings .= ';';

        if( self::saveSettings($settings) )
            \Core\System\Setup::$_config = $_POST;
    }

    /**
     * Saved settings on file
     *
     * @param $settings
     *
     * @return bool|int
     */
    static function saveSettings($settings)
    {
        return file_put_contents(ROOT . DS . self::CONFIG_FILE_NAME, $settings);
    }
}