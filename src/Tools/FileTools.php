<?php

namespace App\Tools;

class FileTools
{
    public static function uploadImage($destinationPath, $file, $oldFileName = null)
    {
        $errors = [];
        $fileName = null;

        if (isset($file["tmp_name"]) && $file["tmp_name"] != '') {
            $checkImage = getimagesize($file["tmp_name"]);
            if ($checkImage !== false) {
                // On récupère l'extension du fichier
                $suffix = pathinfo($file["name"], PATHINFO_EXTENSION);
                //On transforme le nom du fichier en slug pour éviter les problèmes de nom de fichier
                $fileName = StringTools::slugify(basename($file["name"]), '.' . $suffix);
                // On génère un nom de fichier unique
                $fileName = uniqid() . '-' . $fileName;
                // On déplace le fichier
                if (move_uploaded_file($file["tmp_name"], _ROOTPATH_ . $destinationPath . $fileName)) {
                    // On supprime l'ancienne image si elle existe
                    if ($oldFileName) {
                        unlink($destinationPath . $oldFileName);
                    }
                } else throw new \Exception('Erreur lors du chargement du fichier');
            } else throw new \Exception('Le fichier n\'est pas une image');
        }
        return ['fileName' => $fileName ?? null, 'errors' => $errors];
    }
}
