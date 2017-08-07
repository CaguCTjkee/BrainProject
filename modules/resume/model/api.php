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

    /**
     * Add processing on _POST on category page
     */
    static function addCategoryProcessing()
    {
        $name = Request::getInstance()->get('name', 'post', Request::TYPE_STRING);

        if( !empty($name) )
            self::createCategory($name);

        Request::redirect('/admin/resume/category');
    }

    /**
     * Add processing on _POST on single category page
     */
    static function editCategoryProcessing($id)
    {
        self::createCategory(Request::getInstance()->get('name', 'post', Request::TYPE_STRING), null, $id);

        return DB::getRow(self::DB_TABLE_RESUME_CATEGORY, 'category_id = ?', [$id]);
    }

    /**
     * Add processing on _POST on single resume page
     *
     * @param int $resume_id
     */
    static function addResumeProcessing($resume_id = 0)
    {
        $error = '';

        // get params
        $params = [
            'position' => Request::getInstance()->get('position', 'post', Request::TYPE_STRING),
            'category_id' => Request::getInstance()->get('category_id', 'post', Request::TYPE_INT),
            'skills' => Request::getInstance()->get('skills', 'post', Request::TYPE_STRING),
            'salary' => Request::getInstance()->get('salary', 'post', Request::TYPE_STRING),
            'phone' => Request::getInstance()->get('phone', 'post', Request::TYPE_STRING),
            'contacts' => Request::getInstance()->get('contacts', 'post', Request::TYPE_STRING),
            'additional' => Request::getInstance()->get('additional', 'post', Request::TYPE_STRING),
            // education form
            'education-level' => Request::getInstance()->get('education-level', 'post', Request::TYPE_INT),
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
        if( $resume_id > 0 )
            $params['resume_id'] = $resume_id;

        // Check errors
        if( empty($params['position']) )
            $error = 'Position is empty';

        if( empty($params['phone']) )
            $error = 'Phone is empty';

        if( empty($params['skills']) )
            $error = 'Skills is empty';

        if( empty($error) )
        {
            self::getInstance()->createResume(User::getInstance()->getUserId(), $params);

            if( $resume_id === 0 )
                Request::redirect('/resume/view');
        }

        \Core\System\SmartyProcessor::getInstance()->assign('error', $error);
    }

    /**
     * Create resume
     *
     * @param $user_id
     * @param $params
     */
    function createResume($user_id, $params)
    {
        if( $params )
        {
            $getResume = [];
            if( !empty($params['resume_id']) )
            {
                $getResume = DB::getRow(self::DB_TABLE_RESUME, 'resume_id = ?', [$params['resume_id']]);
            }

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

            if( $getResume )
            {
                $resume_id = $getResume['resume_id'];
                DB::update(self::DB_TABLE_RESUME, ['resume_id' => $resume_id], $resume);
                self::deleteResumeAdditional($resume_id);
            }
            else
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

    /**
     * Delete resume
     *
     * @param $resume_id
     */
    static function deleteResume($resume_id)
    {
        DB::delete(self::DB_TABLE_RESUME, 'resume_id = ?', [$resume_id]);
        self::deleteResumeAdditional($resume_id);
    }

    /**
     * Delete only additional resume
     *
     * @param $resume_id
     */
    static function deleteResumeAdditional($resume_id)
    {
        DB::delete(self::DB_TABLE_RESUME_EXPERIENCE, 'resume_id = ?', [$resume_id]);
        DB::delete(self::DB_TABLE_RESUME_EDUCATION, 'resume_id = ?', [$resume_id]);
    }

    /**
     * Create or edit category (if $id is'nt null)
     *
     * @param $name
     * @param null $alt_name
     * @param int $id
     */
    static function createCategory($name, $alt_name = null, $id = 0)
    {
        $alt_name = !empty($alt_name) ? $alt_name : $name;

        // translit
        $alt_name = \Core\System\Translate::russToLat($alt_name);

        $category = [
            'name' => $name,
            'alt_name' => $alt_name
        ];

        if( $id > 0 )
            DB::update(self::DB_TABLE_RESUME_CATEGORY, ['category_id' => (int)$id], $category);
        else
            DB::insert(self::DB_TABLE_RESUME_CATEGORY, $category);
    }

    /**
     * Delete category
     *
     * @param $category_id
     */
    static function deleteCategory($category_id)
    {
        DB::delete(self::DB_TABLE_RESUME_CATEGORY, 'category_id = ?', [$category_id]);
    }
}