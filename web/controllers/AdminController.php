<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 24.05.2020
 * Time: 10:02
 */

class AdminController extends Controller
{
    public function actionLogin()
    {
        if ($this->isAdmin())
            $this->redirect('/');
        $this->login();
        $this->title = "Админ панель";
        return $this->render('login');
    }

    public function actionLogout()
    {
        unset($_SESSION['admin']);
        $this->redirect('/');
    }

    private function login()
    {
        if ($this->isPost()){
            $login = trim(strip_tags($this->getParamPost('login')));
            $password = trim(strip_tags($this->getParamPost('password')));

            if ($login != 'admin' || $password != '123')
                setError('entry' , "Неверный логин или пароль");
            else{
                $this->setParamSession('admin', "admin");
                $this->redirect('/');
            }
            setValue('login', $login);
        }
    }
}