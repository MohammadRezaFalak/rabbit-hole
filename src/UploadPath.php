<?php

namespace RabbitHole;

class UploadPath
{

    private $base;

    public function setBase($base)
    {
        $this->base = $base;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    public function makeUploadPath()
    {

        $year = date("Y");
        $month = date("m");
        $day = date("d");

        $base = $this->getBase();

        $base .= "/$year";

        $this->makeDirectory($base);

        $base .= "/$month";

        $this->makeDirectory($base);

        $base .= "/$day/";

        $this->makeDirectory($base);

        return $base;
    }
}

// $uploadpath = new UploadPath();
// $uploadpath->makeUploadPath();