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
        $currentUrl = key($getAction);
        $urlAction = $this->urlParser->getUrl();
        $segments = $urlAction['path'];
        $functionArg = [];
        $i = 0;
        $actionUrl= explode('/',substr($segments, 1));
        $checkSegment = explode('/', $currentUrl);
        if(count($checkSegment) == count($actionUrl)) {
            foreach ($checkSegment as $segment) {
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
        } else {
            CustomException::wrongRoute();
        }
        //load class and method
        $routeAction = $getAction[$currentUrl];
        //check http request method
        if($routeAction['method'] !== $_SERVER['REQUEST_METHOD']) {
            CustomException::wrongHttpMethod();
        }
        $routeClass = explode('#', $routeAction['namespace']);
        $controller = new $routeClass[0];
        //load controller and send parameter if exist
        echo call_user_func_array([$controller, $routeClass[1]], $functionArg);
    }
}