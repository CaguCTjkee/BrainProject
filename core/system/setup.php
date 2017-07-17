<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 21:19
 */

namespace Core\System;

class Setup extends \Core\Abs\AbstractSetup
{
    function __construct()
    {
        parent::__construct();

        self::$LANGUAGE = 'ru';
    }
}