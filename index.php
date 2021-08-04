<?php

require_once __DIR__ . '/vendor/autoload.php';

use RabbitHole\UploadPath;
use RabbitHole\Upload;

$upload = new Upload();
$uploadPath = new UploadPath();

$upload->tartget_dir = $uploadPath->makeUploadPath();
