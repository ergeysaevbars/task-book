<form method="post">
    <div class="form-group">
        <label for="user">Имя пользователя</label>
        <input type="text" class="form-control <?= errorExists('user') ? "is-invalid" : "" ?>"
               id="user" name="user" value="<?= getValue('user') ?>">
        <?php if (errorExists('user')): ?>
            <div class="invalid-feedback">
                <?= getError('user') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email адрес</label>
        <input type="text" class="form-control <?= errorExists('email') ? "is-invalid" : "" ?>"
               id="exampleInputEmail1" name="email" value="<?= getValue('email') ?>">
        <?php if (errorExists('email')): ?>
            <div class="invalid-feedback">
                <?= getError('email') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="desc">Описание задачи</label>
        <textarea name="task" rows="3" class="form-control <?= errorExists('task') ? "is-invalid" : "" ?>"
                  id="desc"><?= getValue('task') ?></textarea>
        <?php if (errorExists('task')): ?>
            <div class="invalid-feedback">
                <?= getError('task') ?>
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary form-control">Сохранить</button>
</form>