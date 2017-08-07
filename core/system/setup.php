<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 21:19
 */

namespace Core\System;

use Core\Abs\AbstractSetup;

/**
 * Class Setup
 * @package Core\System
 */
class Setup extends AbstractSetup
{
    function __construct()
    {
        parent::__construct();

        // DB setup
        $this->dbSetup();

        // HOST setup
        $this->hostSetup();

        self::$LANGUAGE = 'ru';
    }

    /**
     * Setap host vars
     */
    function hostSetup()
    {
        self::$SITEURL = self::$_config['host'];
        self::$HOME = self::$_config['protocol'] . '://' . self::$_config['host'];
    }

    /**
     * Setup db vars
     */
    function dbSetup()
    {
        self::$DB_HOST = self::$_config['db_host'];
        self::$DB_NAME = self::$_config['db_name'];
        self::$DB_USER = self::$_config['db_user'];
        self::$DB_PASS = self::$_config['db_pass'];
        self::$DB_PREFIX = self::$_config['db_prefix'];
        self::$DB_CHAR = self::$_config['db_char'];
    }

    /**
     * @return string template name
     */
    function getTemplate()
    {
        return self::$TEMPLATE;
    }
}