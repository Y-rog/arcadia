<?php
require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

$conf = require_once 'cloudinary_config.php';
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => $conf['cloudinary_cloud_name'],
    ]
]);

define('_IMAGE_UPLOAD_', 'https://res.cloudinary.com/' . $conf['cloudinary_cloud_name'] . '/image/upload/');
define('_ROOTPATH_', __DIR__);
define('_TEMPLATESPATH_', _ROOTPATH_ . '/templates');
