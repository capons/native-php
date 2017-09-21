<?php

namespace app\system\action\url;

use app\system\action\exception\CustomException;

class UrlLoad {

    private $urlParser;

    public function __construct()
    {
        $this->urlParser = new UrlParser();
    }

    public function boot()
    {
        $getAction =\app\system\action\url\Route::$action;
        $urlAction = $this->urlParser->getUrl();
        $segments =(substr($urlAction['path'], 0, 1) == '/') ? substr($urlAction['path'], 1) : $urlAction['path'];
        $functionArg = [];
        $i = 0;
        $tempUrl = '';
        $actionUrl= explode('/',$segments);
        
        foreach ($getAction as $k => $v) {
            $checkCurrent = count(explode('/',$k));
            $checkMy = count(explode('/',$segments));
            $route = str_replace('}','',$k);
            $route = str_replace('{','',$route);
           // if($route == $segments) {
            if($checkCurrent == $checkMy) {
                if(empty($tempUrl)){
                    $tempUrl = $k;
                }
                $k = explode('/',$k);
                if(is_array($k)){
                    foreach ($k as $segment) {
                        if (preg_match("/^[{]/", $segment) && preg_match('/}$/', $segment)) {
                            //add arguments for class method
                            $functionArg[] = $actionUrl[$i];
                        } else {
                            if ($segment !== $actionUrl[$i]) {
                                CustomException::wrongRoute();
                            }
                        }
                        $i++;
                    }
                }
            } else {
                continue;
            }
        }
        //load class and method
        $routeAction = $getAction[(empty($tempUrl) ? $actionUrl : $tempUrl )];
        //check http request method
        if($routeAction['method'] !== $_SERVER['REQUEST_METHOD']) {
            CustomException::wrongHttpMethod();
        }
        $routeClass = explode('#', $routeAction['namespace']);
        $controller = new $routeClass[0];
        //load controller and send parameter if exist
        if(empty($functionArg)) {
            echo call_user_func_array([$controller, $routeClass[1]],[]);
        } else {
            echo call_user_func_array([$controller, $routeClass[1]], $functionArg);
        }
    }
}