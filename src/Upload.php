<?php

namespace RabbitHole;

use RabbitHole\UploadPath;

class Upload
{
    public $target_dir;
    public $target_file;
    public $uploadOk = 1;
    public $imageFileType;
    public $temp;
    public $newfilename;

    public function __construct()
    {
        $uploadPath = new UploadPath();
        $uploadPath->setBase('./storage');
        $this->target_dir = $uploadPath->makeUploadPath();
        $this->target_file = $this->target_dir . basename($_FILES["fileToUpload"]["name"]);
        $this->imageFileType = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
        $this->temp =  explode(".", $_FILES["fileToUpload"]["name"]);
        $this->newfilename = round(microtime(true)) . '.' . end($this->temp);
    }

    public function start()
    {
        $this->checkFileType();
    }

    public function checkFileType()
    {
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        return $this->checkFileExists($this->target_file);
    }

    public function checkFileExists($target_file)
    {
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        return $this->checkFileSize();
    }

    public function checkFileSize()
    {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        return $this->checkFileFormat($this->imageFileType);
    }

    public function checkFileFormat($imageFileType)
    {
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        return $this->doUpload($this->uploadOk, $this->target_dir, $this->newfilename);
    }

    public function doUpload($uploadOk, $target_dir, $newfilename)
    {
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

