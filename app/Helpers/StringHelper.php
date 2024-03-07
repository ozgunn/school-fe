<?php

namespace App\Helpers;

class StringHelper
{

    public static function toLowerCaseTr($str)
    {
        $str = str_replace(
            ['I', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç'],
            ['ı', 'i', 'ğ', 'ü', 'ş', 'ö', 'ç'],
            $str
        );
        $str = mb_strtolower($str, 'UTF-8');

        return $str;
    }

    public static function toUpperCaseTr($str)
    {
        $str = str_replace(
            ['ı', 'i', 'ğ', 'ü', 'ş', 'ö', 'ç'],
            ['I', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç'],
            $str
        );
        $str = mb_strtoupper($str, 'UTF-8');

        return $str;
    }

    public static function fixNameForDatatable($name)
    {
        return "<span class=\"d-none\">".
            self::toLowerCaseTr($name).
            self::toUpperCaseTr($name).
            "</span>";
    }
}
