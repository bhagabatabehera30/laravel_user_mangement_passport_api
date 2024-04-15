<?php
namespace App\Helper;

class CommonHelper
{
    static public function getRandomString($length = 9, $isCase = false, $isDigit = false)
    {
        if ($isDigit) {
            $characters = '0123456789';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $size = strlen($characters);
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, $size - 1)];
        }
        if ($isCase) {
            $randstring = strtoupper($randstring);
        }
        return $randstring;
    }
}
?>