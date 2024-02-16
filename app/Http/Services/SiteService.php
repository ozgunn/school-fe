<?php

namespace App\Http\Services;

class SiteService
{
    public static function getSchoolsFromClasses($classes)
    {
        $schools = [];
        foreach ($classes as $cls) {
            if (!in_array($cls['school'], $schools)) {
                $schools[] = $cls['school'];
            }
        }

        usort($schools, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $schools;
    }

    public static function getGroupsFromClasses($classes)
    {
        $groups = [];
        foreach ($classes as $cls) {
            if (isset($groups[$cls['school']['id']]) && !in_array($cls['group'], $groups[$cls['school']['id']])) {
                $groups[$cls['school']['id']][] = $cls['group'];
            }
        }

//        usort($groups, function ($a, $b) {
//            return strcmp($a['name'], $b['name']);
//        });

        return $groups;
    }
}
