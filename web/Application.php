<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 22.05.2020
 * Time: 21:16
 */

class Application
{
    private $_routes;
    private $_body;
    
    public function __construct()
    {
        $this->_routes = require_once("config/routes.php");
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach($this->_routes as $key => $value){
            if (preg_match("<^$key$>", $uri)){
                $internalRoute = preg_replace("<$key>", $value, $uri);
                $segments = explode('/', $internalRoute);
                $controller = ucfirst(array_shift($segments)."Controller");
                $action = "action".ucfirst(array_shift($segments));
                if (class_exists($controller)){
                    $rc = new ReflectionClass($controller);
                    if ($rc->hasMethod($action) && $rc->getMethod($action)->isPublic()){
                        $result = $rc->getMethod($action)->invokeArgs(new $controller, $segments);
//                        $result = call_user_func_array([$controller, $action], $segments);
                    }else{
                        throw new Exception("Метод $action в контроллере $controller не существует");
                    }
                }else{
                    throw new Exception("Контроллер $controller не существует");
                }
                break;
            }
        }
        $this->setBody($result);
    }

    private function getURI()
    {
        if (empty(trim(strip_tags($_SERVER['REQUEST_URI']), '/')))
            return 'index';
        return trim(strip_tags($_SERVER['REQUEST_URI']), '/');
    }

    private function setBody($body)
    {
        $this->_body = $body;
    }

    public function getBody()
    {
        return $this->_body;
    }
}