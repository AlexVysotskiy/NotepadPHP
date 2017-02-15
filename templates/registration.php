<?php include 'header.php'; ?>

<div class="col-md-3 col-md-offset-4">

    <h1 class="text-center">
        Регистрация
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
            <label for="login">Логин</label> (допускаются латинские буквы с числами и ./-/_)
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" placeholder="" name="password">
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-default">Регистрация</button>
            <a href="<?php echo $router->generateUrl('login') ?>" class="btn btn-success">
                Войти
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>