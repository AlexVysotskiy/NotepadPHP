<?php include 'header.php'; ?>

<div class="col-md-3 col-md-offset-4">

    <h1 class="text-center">
        <?php if (isset($note)): ?>
            Редактировать заметку #<?php echo $note->getId(); ?>
        <?php else: ?>
            Добавить заметку
        <?php endif; ?>

    </h1>

    <hr>

    <?php if (isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <strong>
                Ошибка!
            </strong>
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label for="header">Заголовок</label>
            <input type="text" class="form-control" id="header" name="header" value="<?php echo isset($note) ? $note->getHeader() : ''; ?>">
        </div>
        <div class="form-group">
            <label for="password">Текст</label>
            <textarea class="form-control" id="text" placeholder="" name="text" style="resize: none" rows="10"><?php echo isset($note) ? $note->getText() : ''; ?></textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-default">Сохранить</button>
            <a href="<?php echo $router->generateUrl('profile') ?>" class="btn btn-success">
                Назад
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>