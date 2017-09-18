<?php

namespace app\system\action\controller;

use app\system\action\view\View;

class Controller {
    
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

}