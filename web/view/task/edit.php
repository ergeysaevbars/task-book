<form method="post">
    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
    <div class="form-group">
        <label for="user">Имя пользователя</label>
        <input type="text" class="form-control" id="user" name="user" value="<?= $task['user_name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $task['email'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="desc">Описание задачи</label>
        <textarea name="task" rows="3" class="form-control" id="desc"><?= $task['task_desc'] ?></textarea>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" id="Check1" class="form-check-input" name="task-check"
            <?= $task['is_checked'] ? 'checked' : '' ?>>
        <label for="Check1">Выполнено</label>
    </div>
    <button type="submit" class="btn btn-primary form-control">Сохранить</button>
</form>