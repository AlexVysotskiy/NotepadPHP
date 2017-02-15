<div clas="row">
    <a href="<?php echo $router->generateUrl('profile') ?>" class="btn btn-success pull-left">
        <?php echo $user->getLogin(); ?>
    </a>
    <a href="<?php echo $router->generateUrl('logout') ?>" class="btn btn-danger pull-right">
        Выйти
    </a>
</div>