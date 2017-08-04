<?php
/**
 * Created by PhpStorm.
 * User: CaguCT
 * Date: 7/16/17
 * Time: 16:10
 */

namespace Core\System;

class Translate
{
    static $LANGUAGE = 'en';
    static $_translate = [];
    static $_langArray = [];

    static function _t($string)
    {
        if( gettype($string) === \Core\System\Request::TYPE_STRING )
        {

            if( \Core\System\Setup::$LANGUAGE !== 'en' )
            {
                $langFilePath = ROOT . DS . 'language' . DS . \Core\System\Setup::$LANGUAGE . '.php';
                if( is_file($langFilePath) && count(self::$_langArray) === 0 )
                {
                    self::$_langArray = require_once $langFilePath;
                }

                $string = strtr($string, self::$_langArray);
            }
        }

        return $string;
    }

    static function russToLat($input, $lower = true)
    {
        if( $lower == true )
            $input = mb_strtolower($input, "utf-8");

        $russ = array(
            "а",
            "б",
            "в",
            "г",
            "д",
            "е",
            "ё",
            "ж",
            "з",
            "и",
            "й",
            "к",
            "л",
            "м",
            "н",
            "о",
            "п",
            "р",
            "с",
            "т",
            "у",
            "ф",
            "х",
            "ц",
            "ч",
            "ш",
            "щ",
            "ъ",
            "ы",
            "ь",
            "э",
            "ю",
            "я",
            " ",
            "#",
            "№",
            "$",
            "%",
            "^",
            "*",
            "!",
            "?",
            "@",
            "'",
            ",",
            ".",
            "&quot;",
            "/",
            "\\",
            "(",
            ")",
            "\"",
            "“",
            "”",
            "+",
            "=",
            ":",
            ";",
            "{",
            "}",
            "[",
            "]",
            "«",
            "»"
        );
        $eng = array(
            "a",
            "b",
            "v",
            "g",
            "d",
            "e",
            "e",
            "zh",
            "z",
            "i",
            "j",
            "k",
            "l",
            "m",
            "n",
            "o",
            "p",
            "r",
            "s",
            "t",
            "u",
            "f",
            "h",
            "c",
            "ch",
            "sh",
            "w",
            "_",
            "y",
            "",
            "e",
            "yu",
            "ya",
            "_",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ".",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
        );

        $input = str_replace($russ, $eng, $input);

        return $input;
    }
}