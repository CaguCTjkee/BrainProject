<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 21:22
 */

namespace Modules\Users\Controller;

use Core\System\DB;
use Core\System\Request;
use Core\System\SmartyProcessor;
use Modules\Users\Model\Api;
use Modules\Users\Model\User;

class Handler
{
    const MODULE_NAME = 'users';
    const MODULE_VERSION = '1.0.0';

    static function Init($router)
    {
        $user = null;
        $hash = Request::getInstance()->get('hash', 'cookie');
        if( !empty($hash) )
        {
            $user = Api::getInstance()->autoLogin($hash);
        }

        SmartyProcessor::getInstance()->assign('user_data', $user);
        SmartyProcessor::getInstance()->assign('is_login', User::$is_login);

        $router->map('GET|POST', '/auth/[a:a]', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Auth#actionIndex', self::MODULE_NAME);
    }

    static function install($user = [])
    {
        /**
         * DB table users ver 1.0.0
         *
         * user_id
         * login
         * mail
         * date_register
         * date_last
         * pass
         * salt
         * activate
         */
        $fields_sql = '`user_id` INT(11) NOT NULL AUTO_INCREMENT ,
                    `login` VARCHAR(40) NOT NULL ,
                    `mail` VARCHAR(80) NOT NULL ,
                    `date_register` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                    `date_last` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                    `pass` VARCHAR(64) NOT NULL ,
                    `salt` VARCHAR(40) NOT NULL ,
                    `activate` INT(1) NOT NULL DEFAULT 0 ,
                    PRIMARY KEY (`user_id`)';
        DB::create(Api::DB_TABLE_USERS, $fields_sql);

        /**
         * DB table users_hash ver 1.0.0
         *
         * user_id
         * date
         * hash
         */
        $fields_sql = '`user_id` INT(11) NOT NULL ,
                       `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                       `hash` VARCHAR(40) NOT NULL';
        DB::create(Api::DB_TABLE_USERS_HASH, $fields_sql);

        /**
         * DB table users_hash ver 1.0.0
         *
         * user_id
         * date
         * hash
         */
        $fields_sql = '`user_id` INT(11) NOT NULL ,
                       `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                       `hash` VARCHAR(40) NOT NULL';
        DB::create(Api::DB_TABLE_USERS_HASH, $fields_sql);

        // Default user
        $user_salt = \Modules\Users\Model\Api::generateSalt(40);
        if( count($user) === 0 )
        {
            $user = [
                'login' => 'admin',
                'mail' => 'admin@resumator.loc',
                'pass' => \Modules\Users\Model\Api::passHash('admin', $user_salt),
                'salt' => $user_salt,
                'activate' => 1,
            ];
        }

        if( Api::getInstance()->getUserByLogin($user['login']) === false )
        {
            Api::getInstance()->createUser($user);
        }

        if( self::MODULE_VERSION !== '1.0.0' )
            self::update();
    }

    static function update()
    {
    }
}