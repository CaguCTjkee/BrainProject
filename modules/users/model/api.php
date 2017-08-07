<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:17
 */

namespace Modules\Users\Model;

use Core\System\DB;
use Core\System\Request;
use Core\System\Setup;

class Api
{
    const DB_TABLE_USERS = 'users';
    const DB_TABLE_USERS_HASH = 'users_hash';
    const DB_TABLE_USERS_INFO = 'users_info';
    //
    protected static $_instance;

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    /**
     * Auth by hash from cookies
     *
     * @param $hash
     *
     * @return bool|User
     */
    function autoLogin($hash)
    {
        $user = DB::getRow('SELECT user.* 
                         FROM ' . Setup::$DB_PREFIX . self::DB_TABLE_USERS_HASH . ' AS user_hash
                         LEFT JOIN ' . Setup::$DB_PREFIX . self::DB_TABLE_USERS . ' AS user
                            ON user_hash.user_id = user.user_id
                         WHERE user_hash.hash = ?', [$hash]);

        if( $user )
        {
            DB::update(self::DB_TABLE_USERS_HASH, ['hash' => $hash], ['date' => date("Y-m-d H:i:s")]);

            $this->updateDateHash($hash);

            return User::getInstance($user);
        }

        return false;
    }

    function updateDateHash($hash)
    {

    }

    /**
     * Auth by login and password
     *
     * @param $login
     * @param $pass
     *
     * @return bool
     */
    function login($login, $pass)
    {
        if( !empty($login) )
        {
            $user = DB::getRow(self::DB_TABLE_USERS, 'login = ?', [$login]);

            if( $user )
            {
                if( $user->pass === self::passHash($pass, $user->salt) )
                {
                    $hash = urlencode(self::generateSalt(10));
                    $this->setHash($user->user_id, $hash);

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Set hash on cookies and DB
     *
     * @param $user_id
     * @param $hash
     */
    function setHash($user_id, $hash)
    {
        DB::insert(self::DB_TABLE_USERS_HASH, [
            'user_id' => $user_id,
            'hash' => $hash,
        ]);
        Request::getInstance()->setCookie('hash', $hash, time() + 60 * 60 * 24 * 30, '/');
    }

    /**
     * @param $redirect - url where redirect after logout
     */
    function logout($redirect = '/')
    {
        // remove loop
        if( $redirect === Setup::$HOME . '/auth/logout' )
            $redirect = '/';

        Request::getInstance()->setCookie('hash', '', time() - 3600, '/');
        \Core\System\Request::redirect($redirect);
    }

    /**
     * @param $login
     *
     * @return mixed (array and object)
     */
    function getUserByLogin($login)
    {
        return DB::getRow(self::DB_TABLE_USERS, 'login = ?', [$login]);
    }

    /**
     * @param array $user [login, mail, pass(passHash(pass, salt), salt, activate, is_admin]
     */
    function createUser($user)
    {
        if( $user )
        {
            DB::insert(self::DB_TABLE_USERS, $user);

            DB::insert(self::DB_TABLE_USERS_INFO, ['user_id' => $user['user_id']]);
        }
    }

    /**
     * @param $user_id - ID of user
     * @param array $user - [login, mail, pass(passHash(pass, salt), salt, activate, is_admin]
     * @param array $user_info - [first_name, last_name, adult, date_birthday(Y-m-d), phone, city, avatar(url)]
     */
    function updateUser($user_id, $user, $user_info = [])
    {
        if( $user )
        {
            DB::update(self::DB_TABLE_USERS, ['user_id' => $user_id], $user);
        }
        if( $user_info )
        {
            $this->saveUserInfo($user_id, $user_info);
        }
    }

    /**
     * @param $user_id
     * @param $params
     */
    function saveUserInfo($user_id, $params)
    {
        $params['date_birthday'] = date("Y-m-d", strtotime($params['date_birthday']));
        DB::update(self::DB_TABLE_USERS_INFO, ['user_id' => $user_id], $params);
    }

    /**
     * @param $user_id
     */
    function deleteUser($user_id)
    {
        DB::delete(self::DB_TABLE_USERS, 'user_id = ?', [$user_id]);
        DB::delete(self::DB_TABLE_USERS_INFO, 'user_id = ?', [$user_id]);
        DB::delete(self::DB_TABLE_USERS_HASH, 'user_id = ?', [$user_id]);
    }

    /**
     * @return bool
     */
    static function isLogin()
    {
        return User::$is_login;
    }

    /**
     *
     * @param string $redirect
     */
    static function authProcessing($redirect = '/')
    {
        $redirect = !empty($redirect) ? $redirect : '/';

        if( $redirect === Setup::$HOME . '/auth/login' )
            $redirect = '/';

        $login = \Core\System\Request::getInstance()->get('login', 'post', \Core\System\Request::TYPE_STRING);
        $pass = \Core\System\Request::getInstance()->get('pass', 'post', \Core\System\Request::TYPE_STRING);

        if( !empty($login) )
        {
            if( \Modules\Users\Model\Api::getInstance()->login($login, $pass) )
            {
                \Core\System\Request::redirect($redirect);
            }
            else
                \Core\System\SmartyProcessor::getInstance()->assign('error', 'Wrong login or password');
        }
    }

    /**
     * This function will be activate when we have $_POST in cabinet
     *
     * @param $user_id
     */
    static function cabinetProcessing($user_id)
    {
        $error = '';

        $params = [
            'avatar' => Request::getInstance()->get('avatar', 'post', Request::TYPE_STRING),
            'first_name' => Request::getInstance()->get('first_name', 'post', Request::TYPE_STRING),
            'last_name' => Request::getInstance()->get('last_name', 'post', Request::TYPE_STRING),
            'adult' => Request::getInstance()->get('adult', 'post', Request::TYPE_STRING),
            'date_birthday' => Request::getInstance()->get('date_birthday', 'post', Request::TYPE_STRING),
            'phone' => Request::getInstance()->get('phone', 'post', Request::TYPE_STRING),
            'city' => Request::getInstance()->get('city', 'post', Request::TYPE_STRING),
        ];

        if( empty($error) )
        {
            \Modules\Users\Model\Api::getInstance()->saveUserInfo($user_id, $params);
            \Core\System\SmartyProcessor::getInstance()->assign('info', 'User info changed');
        }

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    /**
     * This function will be activate when we have $_POST in admin
     *
     * @param $user_id
     */
    static function userEditProcessing($user_id)
    {
        $error = '';

        $user = [
            'login' => Request::getInstance()->get('login', 'post', Request::TYPE_STRING),
            'mail' => Request::getInstance()->get('mail', 'post', Request::TYPE_STRING),
            'pass' => Request::getInstance()->get('pass', 'post', Request::TYPE_STRING),
            'is_admin' => Request::getInstance()->get('is_admin', 'post', Request::TYPE_STRING),
        ];

        if( empty($user['login']) )
            $error = 'Login is empty';

        if( empty($user['mail']) )
            $error = 'Mail is empty';

        // prepare
        if( !empty($user['pass']) )
        {
            $user['salt'] = \Modules\Users\Model\Api::generateSalt(40);
            $user['pass'] = self::passHash($user['pass'], $user['salt']);
        }
        else
            unset($user['pass']);
        $user['is_admin'] = !empty($user['is_admin']) ? 1 : 0;

        // prepare user_info
        $user_info = [
            'avatar' => Request::getInstance()->get('avatar', 'post', Request::TYPE_STRING),
            'first_name' => Request::getInstance()->get('first_name', 'post', Request::TYPE_STRING),
            'last_name' => Request::getInstance()->get('last_name', 'post', Request::TYPE_STRING),
            'adult' => Request::getInstance()->get('adult', 'post', Request::TYPE_STRING),
            'date_birthday' => Request::getInstance()->get('date_birthday', 'post', Request::TYPE_STRING),
            'phone' => Request::getInstance()->get('phone', 'post', Request::TYPE_STRING),
            'city' => Request::getInstance()->get('city', 'post', Request::TYPE_STRING),
        ];

        if( empty($error) )
        {
            self::getInstance()->updateUser($user_id, $user, $user_info);
        }

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    /**
     * This function will be activate when we have $_POST in register
     *
     */
    static function registerProcessing()
    {
        $error = '';

        $params = [
            'login' => \Core\System\Request::getInstance()->get('login', 'post', \Core\System\Request::TYPE_STRING),
            'mail' => \Core\System\Request::getInstance()->get('mail', 'post', \Core\System\Request::TYPE_STRING),
            'pass' => \Core\System\Request::getInstance()->get('pass', 'post', \Core\System\Request::TYPE_STRING),
            'pass_repeat' => \Core\System\Request::getInstance()->get('pass_repeat', 'post', \Core\System\Request::TYPE_STRING),
        ];

        if( empty($params['login']) )
            $error = 'Login is empty';

        if( empty($params['mail']) )
            $error = 'Mail is empty';

        if( empty($params['pass']) )
            $error = 'Password is empty';

        if( empty($params['pass_repeat']) )
            $error = 'Password repeat is empty';

        if( $params['pass'] !== $params['pass_repeat'] )
            $error = 'Password is not equal to password repeat';

        if( empty($error) )
        {
            unset($params['pass_repeat']);
            $register = \Modules\Users\Model\Api::getInstance()->register($params);

            if( $register === true )
            {
                $info = 'Registration success. Now you can use your login and password for login.';
                \Core\System\SmartyProcessor::getInstance()->assign('info', $info);
            }
            else
                $error = $register;
        }

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    /**
     * @param $user
     *
     * @return bool|string
     */
    function register($user)
    {
        $return = true;

        // todo-caguct: test for params

        if( Request::validation($user['login'], Request::TYPE_STRING) === false )
            $return = 'Login isn\'t valid';

        if( DB::getRow(self::DB_TABLE_USERS, 'login = ?', [$user['login']]) !== false )
            $return = 'User with this login is exist';

        if( DB::getRow(self::DB_TABLE_USERS, 'mail = ?', [$user['mail']]) !== false )
            $return = 'User with this mail is exist';

        if( $return === true )
        {
            $user['salt'] = \Modules\Users\Model\Api::generateSalt(40);
            $user['pass'] = self::passHash($user['pass'], $user['salt']);

            self::getInstance()->createUser($user);

            return $return;
        }

        return $return;
    }

    /**
     * @param $pass
     * @param $user_salt
     *
     * @return string
     */
    static function passHash($pass, $user_salt)
    {
        return sha1($pass . $user_salt . SALT);
    }

    /**
     * @param int $num
     * @param bool $sign
     *
     * @return string
     */
    static function generateSalt($num = 10, $sign = true)
    {
        $a = range(0, 9);
        $b = range('a', 'z');
        $c = range('A', 'Z');
        $d = range('!', '@');

        $arr = array_merge($a, $b);
        $arr = array_merge($arr, $a);
        $arr = array_merge($arr, $c);

        if( $sign === true )
            $arr = array_merge($arr, $d);

        $key = '';
        $rand = microtime(true);

        for( $i = 0; $i < $num; ++$i )
        {
            shuffle($arr);
            $countArr = count($arr) - 1;
            $key .= $arr[ceil(round(($rand * 1000 - floor($rand * 1000)), 2) * $countArr)];
            $rand = microtime(true);
        }

        return $key;
    }
}