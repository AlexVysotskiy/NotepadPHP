<?php include 'header.php'; ?>

<div class="col-md-4 col-md-offset-4">

    <?php include 'profile/top_bar.php'; ?>
    <br/>
    <br/>
    <br/>
    <div clas="row">

        <table class="table table-striped"> 
            <thead> 
                <tr>
                    <th>#</th>
                    <th>Тема</th>
                    <th>Текст</th> 
                    <th>Дата</th> 
                    <th>&nbsp;</th> 
                </tr> 
            </thead> 
            <tbody>
                <?php foreach ($notes->getValue() as $note): ?>
                    <tr> 
                        <th scope="row">
                            <?php echo $note->getId(); ?>
                        </th> 
                        <td>
                            <?php
                            $header = $note->getHeader();
                            echo strlen($header) > 10 ? substr($header, 0, 7) . '..' : $header;
                            ?>
                        </td>
                        <td>
                            <?php
                            $text = $note->getText();
                            echo strlen($text) > 10 ? substr($text, 0, 7) . '..' : $text;
                            ?>

                        </td> 
                        <td>
                            <?php
                            echo $note->getCreationDate()->format('H:i:m d-m-Y');
                            ?>
                        </td> 
                        <td>

                            <a href="<?php echo $router->generateUrl('editNote', array('noteId' => $note->getId())); ?>">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>

                            <a href="<?php echo $router->generateUrl('removeNote', array('noteId' => $note->getId())); ?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </td> 
                    </tr>
                <?php endforeach; ?>


            </tbody> 
        </table>


        <?php if ($notes->getTotal() > $notes->getLimit()): ?>
            <?php $totalPages = ceil($notes->getTotal() / $notes->getLimit()); ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="<?php echo $router->generateUrl($routeInfo['name']); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = 0; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="<?php echo $router->generateUrl($routeInfo['name'], array('page' => $i)); ?>">
                                <?php echo $i + 1; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li>
                        <a href="<?php echo $router->generateUrl($routeInfo['name'], array('page' => $totalPages)); ?>"aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>


    </div>

    <br/>
    <br/>
    <br/>
    <div clas="row">
        <a href="<?php echo $router->generateUrl('addNote') ?>" class="btn btn-success pull-right">
            Добавить
        </a>
    </div>
</div>



<?php include 'footer.php'; ?>