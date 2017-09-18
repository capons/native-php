<?php

namespace app\system\action\exception;

use app\system\action\url\UrlParser;
use Exception;

class CustomException
{
    public static function wrongRoute()
    {
        $url = new UrlParser();
        $route = $url->getUrl();
        throw new Exception("Route ".$route['path']." do not exist");
    }

    public static function wrongHttpMethod()
    {
        throw new Exception("Wrong http request method");
    }
}