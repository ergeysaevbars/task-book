<?php
if ($this->isAdmin()){
    $href = "/admin/logout";
    $value = "Выход";
}else{
    $href = "/admin";
    $value = "Админ панель";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <title><?= !$this->title ? "Главная" : $this->title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Задачник</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/new_task">Добавить новую задачу</a>
            </li>
        </ul>
        <a href="<?= $href ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit"><?= $value ?></a>
    </div>
</nav>
<div class="container">
    <?= $content ?>
</div>
</body>
<!--<script src="/assets/js/task.js"></script>-->
</html>