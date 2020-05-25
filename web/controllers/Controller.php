<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 22.05.2020
 * Time: 23:00
 */

class Controller
{
    protected $layout = true;

    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            return true;
        }
    }

    public function getParamGet($param)
    {
        return $_GET[$param];
    }

    public function getParamPost($param)
    {
        return $_POST[$param];
    }

    public function setParamSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function isAdmin()
    {
        return $_SESSION['admin'] == "admin";
    }

    protected function getReferer()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    final protected function render($view, $args = null)
    {
        $folder = str_replace('Controller', '', get_called_class());
        $folder = strtolower($folder);
        ob_start();
        extract($args);
        require_once ROOT . "/web/view/$folder/$view.php";
        $page = ob_get_clean();
        $res = $this->layout ? $this->renderMain($page) : $page;
        return $res;
    }

    private function renderMain($content)
    {
        ob_start();
        require_once ROOT . "/web/view/layouts/main.php";
        return ob_get_clean();

    }

    protected function redirect($link)
    {
        header("Location: $link");
        exit();
    }

}