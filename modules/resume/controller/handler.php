<?php

/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/14/17
 * Time: 21:22
 */

namespace Modules\Resume\Controller;

use Core\System\DB;
use Modules\Resume\Model\Api;

class Handler
{
    const MODULE_NAME = 'resume';

    static function Init($router)
    {
        $router->map('GET|POST', '/resume/[a:a]', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Resume#actionIndex', 'resume');
        $router->map('GET|POST', '/resume/[a:a]/[i:b]', '\Modules\\' . self::MODULE_NAME . '\Controller\Front\Resume#actionIndex', 'resume_full');

        // admin
        $router->map('GET|POST', '/admin/resume/[a:a]', '\Modules\\' . self::MODULE_NAME . '\Controller\Admin\Resume#actionIndex', 'admin-resume');
        $router->map('GET|POST', '/admin/resume/[a:a]/[i:b]', '\Modules\\' . self::MODULE_NAME . '\Controller\Admin\Resume#actionIndex', 'admin-resume-id');
    }

    static function install()
    {
        /**
         * DB table resume ver 1.0.0
         *
         * resume_id
         * user_id
         * date_add
         * position
         * category_id
         * skills
         * salary
         * phone
         * contacts
         * additional
         */
        $fields_sql = '`resume_id` INT(11) NOT NULL AUTO_INCREMENT ,
                    `user_id` INT(11) NOT NULL ,
                    `date_add` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                    `position` VARCHAR(255) NOT NULL ,
                    `category_id` INT(11) NOT NULL DEFAULT 0 ,
                    `skills` TEXT NOT NULL ,
                    `salary` VARCHAR(255) NOT NULL ,
                    `phone` VARCHAR(40) NOT NULL ,
                    `contacts` TEXT NOT NULL ,
                    `additional` TEXT NOT NULL ,
                    PRIMARY KEY (`resume_id`)';
        DB::create(Api::DB_TABLE_RESUME, $fields_sql);

        /**
         * DB table resume category ver 1.0.0
         *
         * category_id
         * alt_name
         * name
         */
        $fields_sql = '`category_id` INT(11) NOT NULL AUTO_INCREMENT ,
                    `alt_name` VARCHAR(40) NOT NULL ,
                    `name` VARCHAR(40) NOT NULL ,
                    PRIMARY KEY (`category_id`)';
        DB::create(Api::DB_TABLE_RESUME_CATEGORY, $fields_sql);

        // Default categories
        $categories = [
            'HR специалисты',
            'IT',
            'Автобизнес',
            'Административный',
            'Банки',
            'Бухгалтерия',
            'Гостиницы',
            'Государственные',
            'Дизайн',
            'Закупки',
            'Консалтинг',
            'Культура',
            'Логистика',
            'Маркетинг',
            'Медиа',
            'Медицина',
            'Морские',
            'Наука',
            'Недвижимость',
            'Некоммерческие',
            'Охрана',
            'Продажи',
            'Производство',
            'Рабочие',
            'Сельское хозяйство',
            'Спорт',
            'Страхование',
            'Строительство',
            'Студенты',
            'Телекоммуникации',
            'Топ-менеджмент',
            'Торговля',
            'Туризм',
        ];
        foreach( $categories as $id => $category )
        {
            Api::createCategory($category);
        }

        /**
         * DB table resume experience ver 1.0.0
         *
         * resume_id
         * name_company
         * position
         * date_start
         * date_end
         * present_time
         */
        $fields_sql = '`resume_id` INT(11) NOT NULL ,
                    `name_company` VARCHAR(255) NOT NULL ,
                    `position` VARCHAR(255) NOT NULL ,
                    `date_start` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                    `date_end` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                    `present_time` INT(1) NOT NULL DEFAULT 0';
        DB::create(Api::DB_TABLE_RESUME_EXPERIENCE, $fields_sql);

        /**
         * DB table resume education ver 1.0.0
         *
         * resume_id
         * level
         * school
         * city
         * speciality
         * year
         */
        $fields_sql = '`resume_id` INT(11) NOT NULL ,
                    `level` INT(2) NOT NULL ,
                    `school` VARCHAR(255) NOT NULL ,
                    `city` VARCHAR(255) NOT NULL ,
                    `speciality` VARCHAR(255) NOT NULL ,
                    `year` INT(4) NOT NULL';
        DB::create(Api::DB_TABLE_RESUME_EDUCATION, $fields_sql);
    }
}