<?php
return [
    'sort' => "task/sort",
    'admin/task_edit/task(\d+)' => "task/edit/$1",
    'admin/logout' => "admin/logout",
    'admin' => "admin/login",
    'task/(\d+)' => "task/view/$1",
    'new_task' => "task/add",
    'page(\d+)/sort/(id|username|email|task)/order/(asc|desc)' => "index/index/$1/$2/$3",
    'page(\d+)' => "index/index/$1",
    'index' => "index/index"
];