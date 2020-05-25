<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);


set_include_path(get_include_path().
    PATH_SEPARATOR."web".
    PATH_SEPARATOR."web/controllers".
    PATH_SEPARATOR."web/models");

spl_autoload_register(function ($class){
    spl_autoload($class);
});

define('ROOT', dirname(__FILE__));
require_once ROOT."/web/config/helper.php";

try {
    $app = new Application();
    $app->run();
    echo $app->getBody();
}catch (Exception $e){
    echo $e->getMessage();
}