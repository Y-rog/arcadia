<?php

namespace App\Tools;

class StringTools extends Tools
{

    public static function toCamelCase($value, $pascalCase = false)
    {
        $value = ucwords(str_replace(array('-', '_'), ' ', $value));
        $value = str_replace(' ', '', $value);
        if ($pascalCase === false) {
            return lcfirst($value);
        } else {
            return $value;
        }
    }
    public static function toPascalCase($value)
    {

        return self::toCamelCase($value, true);
    }

    public static function formatDateTime($date)
    {
        $date = new \DateTime($date);
        return $date->format('d/m/Y H:i:s');
    }
}
