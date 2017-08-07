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
use Modules\Resume\Controller\Handler;
use Modules\Users\Model\User;

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

        $params = [
            'position' => Request::getInstance()->get('position', 'post', Request::TYPE_STRING),
            'category_id' => Request::getInstance()->get('category_id', 'post', Request::TYPE_INT),
            'skills' => Request::getInstance()->get('skills', 'post', Request::TYPE_STRING),
            'salary' => Request::getInstance()->get('salary', 'post', Request::TYPE_STRING),
            'phone' => Request::getInstance()->get('phone', 'post', Request::TYPE_STRING),
            'contacts' => Request::getInstance()->get('contacts', 'post', Request::TYPE_STRING),
            'additional' => Request::getInstance()->get('additional', 'post', Request::TYPE_STRING),
            // education form
            'education-level' => Request::getInstance()->get('education-level', 'post', Request::TYPE_ARRAY),
            'education-school' => Request::getInstance()->get('education-school', 'post', Request::TYPE_ARRAY),
            'education-city' => Request::getInstance()->get('education-city', 'post', Request::TYPE_ARRAY),
            'education-speciality' => Request::getInstance()->get('education-speciality', 'post', Request::TYPE_ARRAY),
            'education-year' => Request::getInstance()->get('education-year', 'post', Request::TYPE_ARRAY),
            // experience form
            'experience-never_work' => Request::getInstance()->get('experience-never_work', 'post', Request::TYPE_ARRAY),
            'experience-name_company' => Request::getInstance()->get('experience-name_company', 'post', Request::TYPE_ARRAY),
            'experience-position' => Request::getInstance()->get('experience-position', 'post', Request::TYPE_ARRAY),
            'experience-date_start' => Request::getInstance()->get('experience-date_start', 'post', Request::TYPE_ARRAY),
            'experience-date_end' => Request::getInstance()->get('experience-date_end', 'post', Request::TYPE_ARRAY),
            'experience-present_time' => Request::getInstance()->get('experience-present_time', 'post', Request::TYPE_ARRAY),
        ];

        if( empty($params['position']) )
            $error = 'Position is empty';

        if( empty($params['phone']) )
            $error = 'Phone is empty';

        if( empty($params['skills']) )
            $error = 'Skills is empty';

        if( empty($error) )
        {
            self::getInstance()->createResume(User::getInstance()->getUserId(), $params);
            Request::redirect('/resume/view');
        }

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    function createResume($user_id, $params)
    {
        if( $params )
        {
            $resume = [
                'user_id' => $user_id,
                'position' => $params['position'],
                'category_id' => $params['category_id'],
                'skills' => $params['skills'],
                'salary' => $params['salary'],
                'phone' => $params['phone'],
                'contacts' => $params['contacts'],
                'additional' => $params['additional'],
            ];
            $resume_id = DB::insert(self::DB_TABLE_RESUME, $resume);

            foreach( $params['education-level'] as $id => $row )
            {
                $education = [
                    'resume_id' => $resume_id,
                    'level' => $params['education-level'][$id],
                    'school' => $params['education-school'][$id],
                    'city' => $params['education-city'][$id],
                    'speciality' => $params['education-speciality'][$id],
                    'year' => $params['education-year'][$id],
                ];
                DB::insert(self::DB_TABLE_RESUME_EDUCATION, $education);
            }

            if( empty($params['experience-never_work']) && $params['experience-never_work'] !== '1' )
            {
                foreach( $params['experience-name_company'] as $id => $row )
                {
                    $experience = [
                        'resume_id' => $resume_id,
                        'name_company' => $params['experience-name_company'][$id],
                        'position' => $params['experience-position'][$id],
                        'date_start' => !empty($params['experience-date_start'][$id]) ? date("Y-m-d H:i:s", strtotime($params['experience-date_start'][$id])) : null,
                        'date_end' => !empty($params['experience-date_end'][$id]) ? date("Y-m-d H:i:s", strtotime($params['experience-date_end'][$id])) : null,
                        'present_time' => !empty($params['experience-present_time'][$id]) ? 1 : 0,
                    ];
                    DB::insert(self::DB_TABLE_RESUME_EXPERIENCE, $experience);
                }
            }
        }
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