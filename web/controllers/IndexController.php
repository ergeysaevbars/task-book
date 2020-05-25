<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 22.05.2020
 * Time: 22:15
 */

class IndexController extends Controller
{
    public function actionIndex($page = null, $sort = 'id', $order = 'asc')
    {
        if (!$page)
            $this->redirect("/page1/sort/$sort/order/$order");
        $sortFields = [
            'username' => "Сортировать по имени пользователя",
            'email' => "Сортировать по email",
            'task' => "Сортировать тексту задачи"
        ];
        $orderFields = [
            'asc' => "Сортировать по возрастанию",
            'desc' => "Сортировать по убыванию",
        ];

        switch ($sort){
            case 'username': $sortField = "user_name"; break;
            case 'email': $sortField = "email"; break;
            case 'task': $sortField = "task_desc"; break;
            default: $sortField = 'id';
        }

        $currentPage = $page;
        $count = Task::getInstance()->getListCount();
        $limit = 3;
        $pagesCount = ceil($count / $limit);
        $offset = ((int)abs($page) - 1) * $limit;
        $taskList = Task::getInstance()->getList($offset, $limit, $sortField, $order);
        return $this->render('index',
            compact('taskList', 'pagesCount', 'currentPage', 'sort', 'order', 'sortFields', 'orderFields'));
    }
}