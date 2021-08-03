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
    
        $arg = "./$year";
    
        makeDirectory($arg);
    
        $arg .= "/$month";
    
        makeDirectory($arg);
    
        $arg .= "/$day";
    
        makeDirectory($arg);
    
        return $arg;
    }
    
    echo makeUploadPath();
}