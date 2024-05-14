<?php

namespace App\Tools;

use Cloudinary\Cloudinary;

class FileTools
{

    public static function uploadImage($file, $oldPublicId)
    {
        $errors = [];

        if (isset($file["tmp_name"]) && $file["tmp_name"] != '') {
            $checkImage = getimagesize($file["tmp_name"]);
            if ($checkImage !== false) {
                $conf = require_once _ROOTPATH_ . '/cloudinary_config.php';
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => $conf['cloudinary_cloud_name'],
                        'api_key' => $conf['cloudinary_api_key'],
                        'api_secret' => $conf['cloudinary_api_secret'],
                        'url' => $conf['cloudinary_url'],
                        'secure' => true,
                    ]
                ]);
                $publicId = $cloudinary->uploadApi()->upload($file['tmp_name'])['public_id'];
                if ($oldPublicId) {
                    $cloudinary->uploadApi()->destroy($oldPublicId);
                }
            } else {
                $errors['file'] = 'Le fichier doit être une image';
            }
        } else {
            $errors['file'] = 'L\'image n\'a pas été téléchargée';
        }
        return ['public_id' => $publicId ?? null, 'errors' => $errors];
    }

    public static function deleteImage($publicId)
    {
        $conf = require_once _ROOTPATH_ . '/cloudinary_config.php';
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $conf['cloudinary_cloud_name'],
                'api_key' => $conf['cloudinary_api_key'],
                'api_secret' => $conf['cloudinary_api_secret'],
                'url' => $conf['cloudinary_url'],
                'secure' => true,
            ]
        ]);
        $cloudinary->uploadApi()->destroy($publicId);
    }
}
