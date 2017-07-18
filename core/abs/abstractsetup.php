<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 21:11
 */

namespace Core\Abs;

abstract class AbstractSetup
{
    static $VERSION = '1.0.0';
    static $AUTHOR = 'CaguCT';
    static $SITEURL = '';
    static $HOME = '';
    static $TEMPLATE = 'mainTemplate';
    static $MODULESURL = 'modules';
    static $LANGUAGE = 'en';
    // DB
    static $DB_HOST = 'localhost';
    static $DB_NAME = 'resumator';
    static $DB_USER = 'root';
    static $DB_PASS = '';
    static $DB_PREFIX = '';
    static $DB_CHAR = 'utf8';
    // config
    static $_config;

    function __construct()
    {
        $this->init();

        $configPath = ROOT . DS . 'config.auto.php';

        if( is_file($configPath) )
        {
            include_once $configPath;
            self::$_config = $_config;
        }
    }

    function init()
    {
        header("Content-Type: text/html; charset=utf-8");
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Europe/Kiev");
    }
}