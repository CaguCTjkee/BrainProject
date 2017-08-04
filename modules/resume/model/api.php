<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/17/17
 * Time: 17:17
 */

namespace Modules\Resume\Model;

use Core\System\DB;
use Core\System\Request;
use Core\System\Setup;

class Api
{
    const DB_TABLE_RESUME = 'resume';
    const DB_TABLE_RESUME_CATEGORY = 'resume_category';
    const DB_TABLE_RESUME_EXPERIENCE = 'resume_experience';
    const DB_TABLE_RESUME_EDUCATION = 'resume_education';
    protected static $_instance;

    static function getInstance()
    {
        if( self::$_instance === null )
            self::$_instance = new self();

        return self::$_instance;
    }

    static function addResumeProcessing()
    {

        $error = '';

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    static function createCategory($name, $alt_name = null)
    {
        $alt_name = !empty($alt_name) ? $alt_name : $name;

        // translit
        $alt_name = \Core\System\Translate::russToLat($alt_name);

        $category = [
            'name' => $name,
            'alt_name' => $alt_name
        ];

        DB::insert(self::DB_TABLE_RESUME_CATEGORY, $category);
    }
}