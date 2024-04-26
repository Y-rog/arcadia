<?php

namespace App\Tools;

class StringTools
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

    /*
        Transforme une chaine pour la rendre valide pour les urls, nom de fichier
    */
    public static function slugify($text, string $divider = '-')
    {
        // remplacer les caractères spéciaux par des caractères normaux
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // translitere les caractères
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // supprimer les caractères non alphanumériques
        $text = preg_replace('~[^-\w]+~', '', $text);

        // enlève les espaces
        $text = trim($text, $divider);

        // supprimer les caractères en double
        $text = preg_replace('~-+~', $divider, $text);

        // passer en minuscule
        $text = strtolower($text);

        // si vide, retourner n-a
        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
