<?php
/**
 * Created by PhpStorm.
 * User: Thecr
 * Date: 26/01/2016
 * Time: 19:56
 */

namespace App\Vendor;


class User
{
    public static function redirect($url) {
        return header('Location: ' . $url);
    }
}