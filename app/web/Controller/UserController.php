<?php

namespace app\web\Controller;
use app\system\action\controller\Controller;

class UserController extends Controller
{
    public function index($id = null)
    {
        $this->view->dataOne = $id;
        return $this->view->render();
    }
}