<?php

namespace app\system\action\url;

class Route {

    static $action = [];

    public static function get($url, $class)
    {
        $param['namespace'] = $class;
        $param['method'] = 'GET';
        self::$action[$url] = $param;
    }

    public static function post($url, $class)
    {
        $param['namespace'] = $class;
        $param['method'] = 'POST';
        self::$action[$url] = $param;
    }

    public static function delete($url, $class)
    {
        $param['namespace'] = $class;
        $param['method'] = 'DELETE';
        self::$action[$url] = $param;
    }

    public static function put($url, $class)
    {
        $param['namespace'] = $class;
        $param['method'] = 'PUT';
        self::$action[$url] = $param;
    }
}