<?php

namespace App\Tools;

class FileTools
{
    public static function uploadImage($destinationPath, $file, $oldFileName)
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
                    if (move_uploaded_file($file["tmp_name"], _ROOTPATH_ . $destinationPath . $fileName)) {
                        if ($oldFileName) {
                            unlink(_ROOTPATH_ . $destinationPath . $oldFileName);
                        }
                    } else {
                        $errors[] = "Une erreur est survenue lors de l'upload de l'image";
                    }
                } else {
                    $errors['file'] = 'Le fichier n\'a pas été uploadé';
                }
            } else {
                $errors['file'] = 'Le fichier doit être une image';
            }
        }
        return ['fileName' => $fileName ?? null, 'errors' => $errors];
    }

    public static function deleteImage($destinationPath, $fileName)
    {
        if ($fileName) {
            unlink(_ROOTPATH_ . $destinationPath . $fileName);
        }
    }
}
