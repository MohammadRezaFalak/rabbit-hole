<?php

class UploadPath
{
    function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    function makeUploadPath()
    {

        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $base = "./storage";

        $base .= "/$year";

        $this->makeDirectory($base);

        $base .= "/$month";

        $this->makeDirectory($base);

        $base .= "/$day";

        $this->makeDirectory($base);

        return $base;
    }
}
