<?php

namespace App\Helpers;

class Helper
{
    public static function xmlToArray($url)
    {
        $fileContents = file_get_contents($url);

        $xml = simplexml_load_string($fileContents);

        $json = json_encode($xml);

        $array = json_decode($json, true);

        return $array;
    }
}