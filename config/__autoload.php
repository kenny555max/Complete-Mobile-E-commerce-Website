<?php

    spl_autoload_register("autoLoader");

    function autoLoader($className) {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        if (strpos($url, "config")) {
            $path = "../classes/";
        }else{
            $path = "classes/";
        }

        $ext = ".class.php";

        $filePath = $path . $className . $ext;

        require_once $filePath;
    }