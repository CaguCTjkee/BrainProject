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
    static $SITEURL = 'bp.lc';
    static $HOME = 'http://bp.lc';
    static $TEMPLATE = 'mainTemplate';
    static $MODULESURL = 'modules';
    static $LANGUAGE = 'en';

    function __construct()
    {
        $this->init();


    }

    function init()
    {
        header("Content-Type: text/html; charset=utf-8");
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Europe/Kiev");
    }
}