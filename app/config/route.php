<?php

use app\system\action\url\Route;

Route::get('test/{id}', '\app\web\Controller\UserController#index');