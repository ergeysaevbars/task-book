<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 23.05.2020
 * Time: 18:04
 */

class Task
{
    private static $_instance;
    private $_db;

    private function __construct()
    {
        $this->_db = DataBase::getInstace();
    }

    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function add($name, $email, $task)
    {
        return $this->_db->insert("INSERT INTO task_list (user_name, email, task_desc) VALUES (?, ?, ?)",
            [$name, $email, $task]);
    }

    public function edit($id, $task, $is_checked)
    {
        $is_updated = $task != $this->getTaskByID($id)['task_desc'] ? ", is_updated = 1" : "";
        $this->_db->beginTransaction();
        try{
            $res = $this->_db->update(
                "UPDATE task_list SET task_desc = :task, is_checked = :checked$is_updated WHERE id = :id",
                ['task' => $task, 'checked' => $is_checked, 'id' => $id]);
            $this->_db->commitTransaction();
        }catch (PDOException  $e){
            $this->_db->rollBackTransaction();
//            echo $e->getMessage();
        }
        return $res;
    }

    public function getList($offset, $limit, $sort, $order)
    {
        return $this->_db->select("SELECT * FROM task_list ORDER BY $sort $order LIMIT $offset, $limit");
    }

    public function getListCount()
    {
        return $this->_db->select("SELECT COUNT(*) `count` FROM task_list")[0]['count'];
    }

    public function getTaskByID($id)
    {
        return $this->_db->select("SELECT * FROM task_list WHERE id = ?", [$id])[0];
    }
}