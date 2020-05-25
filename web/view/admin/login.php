<form method="post">
    <?php if (errorExists('entry')): ?>
        <div class="alert alert-danger" role="alert">
            <?= getError('entry') ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login"
               name="login" value="<?= getValue('login') ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" class="form-control"
               id="exampleInputPassword1" name="password">
    </div>
    <button type="submit" class="btn btn-primary form-control">Войти</button>
</form>