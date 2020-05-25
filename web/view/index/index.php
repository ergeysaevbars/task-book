<h4 align="center">Список задач</h4>
<form action="/sort" method="post">
    <div class="row">
        <input type="hidden" name="page" value="<?= $currentPage ?>">
        <div class="col col-sm-6">
            <?php foreach ($sortFields as $key => $field): ?>
                <input type="radio" class="sort" name="sort" id="<?= $key ?>" value="<?= $key ?>"
                    <?= $key == $sort ? 'checked' : '' ?>>
                <label for="<?= $key ?>"><?= $field ?></label>
                <br>
            <?php endforeach; ?>
        </div>
        <div class="col col-sm-6">
            <?php foreach ($orderFields as $key => $orderField): ?>
                <input type="radio" class="order" name="order" id="<?= $key ?>" value="<?= $key ?>"
                <?= $key == $order ? 'checked' : '' ?>>
                <label for="<?= $key ?>"><?= $orderField ?></label>
                <br>
            <?php endforeach; ?>
        </div>
    </div>
    <button class="btn btn-outline-primary">Сортировать</button>
    <hr>
</form>
<?php if (getValue('success')): ?>
    <div class="alert alert-success" role="alert">
        Запись успешно добавлена
    </div>
<?php endif; ?>
<table class="table">
    <thead>
    <tr>
        <td>Имя пользователя</td>
        <td>E-mail</td>
        <td>Задача</td>
        <td>Статус</td>
        <?php if ($this->isAdmin()): ?>
            <td></td>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($taskList as $list): ?>
        <tr>
            <td width="20%"><?= $list['user_name'] ?></td>
            <td width="20%"><?= $list['email'] ?></td>
            <td width="20%"><?= $list['task_desc'] ?></td>
            <td width="20%">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="Check1" disabled
                        <?= $list['is_checked'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="Check1">Выполнено</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="Check2" disabled
                        <?= $list['is_updated'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="Check2">Отредактировано администратором</label>
                </div>
            </td>
            <?php if ($this->isAdmin()): ?>
                <td width="20%">
                    <a href="/admin/task_edit/task<?= $list['id'] ?>" class="btn btn-sm btn-primary">Редактировать</a>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <?php for ($page = 1; $page <= $pagesCount; $page++): ?>
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <a href="/page<?= $page ?>/sort/<?= $sort ?>/order/<?= $order ?>"
               class="btn btn-<?= $currentPage == $page ? "" : "outline-" ?>info">
                <?= $page ?>
            </a>
        </div>
    <?php endfor; ?>
</div>

