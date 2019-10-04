<?php

if (!function_exists('getFolderPathForId')) {
    function getFolderPathForId($id)
    {
        if ($id < 10) {
            return "0/";
        } else {
            $folders = str_split($id);
            array_pop($folders);
            return implode("/", $folders) . "/";
        }
    }
}

