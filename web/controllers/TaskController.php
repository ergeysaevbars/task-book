<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 22.05.2020
 * Time: 22:41
 */

class TaskController extends Controller
{
    public function actionAdd()
    {
        $this->newTask();
        $this->title = "Новая задача";
        return $this->render('add');
    }

    public function actionEdit($id)
    {
        if (!$this->isAdmin())
            $this->redirect('/');
        $this->editTask();
        $id = (int)abs($id);
        $task = Task::getInstance()->getTaskByID($id);
        return $this->render('edit', compact('task'));
    }

    public function actionSort()
    {
        if ($this->isPost()){
            $page = (int)abs($this->getParamPost('page'));
            $sort = trim(strip_tags($this->getParamPost('sort')));
            if (!$sort)
                $sort = 'id';
            $order = trim(strip_tags($this->getParamPost('order')));
            $this->redirect("page$page/sort/$sort/order/$order");
        }
    }

    private function editTask()
    {
        if ($this->isPost()){
            if(!$this->isAdmin()) {
                $this->redirect('/admin');
            }
            $id = (int)abs($this->getParamPost('task_id'));
            $task = htmlspecialchars($this->getParamPost('task'));
            $is_checked = $this->getParamPost('task-check') ? 1 : 0;
            $res = Task::getInstance()->edit($id, $task, $is_checked);
            if ($res)
                $this->redirect('/');
        }
    }

    private function newTask()
    {
        if ($this->isPost()){
            $user = trim(preg_replace('/\s{2,}/', ' ', strip_tags($this->getParamPost('user'))));
            $email = trim(strip_tags($this->getParamPost('email')));
            $task = htmlspecialchars($this->getParamPost('task'));

            if (empty($user))
                setError('user' , "Не заполнено имя пользователя");
            setValue('user', $user);

            if (empty($email))
                setError('email' , "Не заполнен email адрес");
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
                setError('email' , "Email адрес $email указан неверно");
            setValue('email', $email);

            if (empty($task))
                setError('task', "Не указана задача");
            setValue('task', $task);

            if (!getCountErrors()){
                $res = Task::getInstance()->add($user, $email, $task);
                if ($res) {
                    unset($_SESSION['values']);
                    setValue('success', "Задача успешно добавлена");
                    $this->redirect("/");
                }
            }
        }
    }
}