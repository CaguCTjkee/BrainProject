<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:17
 */

namespace Modules\Users\Model;

use Core\System\DB;

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

    function login()
    {
    }

    function loginByToken()
    {
    }

    function logout()
    {
    }

    function getUserByLogin($login)
    {
        return DB::getRow(self::DB_TABLE_USERS, 'login = ?', [$login]);
    }

    function createUser($user)
    {
        if( $user )
            DB::insert(self::DB_TABLE_USERS, $user);
    }

    static function isLogin()
    {
        return false;
    }

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