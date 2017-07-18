<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/18/17
 * Time: 09:37
 */

namespace Core\System;

use \Core\System\Setup as Setup;

class DB
{
    protected static $_instance;

    public static function instance()
    {
        if( self::$_instance === null )
        {
            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => true,
            );
            $dsn = 'mysql:host=' . Setup::$DB_HOST . ';dbname=' . Setup::$DB_NAME . ';charset=' . Setup::$DB_CHAR;
            self::$_instance = new \PDO($dsn, Setup::$DB_USER, Setup::$DB_PASS, $options);
        }

        return self::$_instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);

        return $stmt;
    }
}