<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/10/17
 * Time: 21:19
 */

namespace Core\System;

use Core\Abs\AbstractSetup;

class Setup extends AbstractSetup
{
    function __construct()
    {
        parent::__construct();

        self::$LANGUAGE = 'ru';
    }

    function getTemplate()
    {
        return self::$TEMPLATE;
    }
}