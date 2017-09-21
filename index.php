<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require_once("app/Autoloader.php");
require_once("app/config/constant.php");
require_once("app/config/route.php");

$content = new \app\system\action\url\UrlLoad();
$content->boot();











