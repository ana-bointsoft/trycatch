<?php /**
     * Class used to autoload any class , triggered each time a class is called
     * 
     * @param string $name
     */
    function __autoload($name) {
        $fullpath = "../".strtolower($name).'.class.php';
        $fullpath = str_replace('\\', '/',$fullpath);
        if(file_exists($fullpath)) require ($fullpath);
    }