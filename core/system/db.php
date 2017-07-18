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

    public static function pdoSet($allowed, &$values, $source = array())
    {
        $set = '';
        $values = array();
        if( !$source )
            $source = &$_POST;
        foreach( $allowed as $field )
        {
            if( isset($source[$field]) )
            {
                $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
                $values[$field] = $source[$field];
            }
        }

        return substr($set, 0, -2);
    }

    public static function create($table, $fields_sql)
    {
        $isset_table = self::run('SHOW TABLES LIKE ?', [Setup::$DB_PREFIX . $table])->fetchColumn();

        if( $isset_table === false )
        {
            self::run('CREATE TABLE `' . Setup::$DB_PREFIX . $table . '` (' . $fields_sql . ') ENGINE = InnoDB;');
        }
    }

    public static function getRow($table, $where = '', $args = [])
    {
        $where = !empty($where) ? ' WHERE ' . $where : null;

        return self::run('SELECT * FROM ' . Setup::$DB_PREFIX . $table . $where, $args)->fetch(\PDO::FETCH_LAZY);
    }

    public static function insert($table, $data = [])
    {
        if( $data )
        {
            $allowed = array_keys($data);

            self::run('INSERT INTO ' . Setup::$DB_PREFIX . $table . ' SET ' . self::pdoSet($allowed, $values, $data), $values);

            return self::lastInsertId();
        }

        return false;
    }
}