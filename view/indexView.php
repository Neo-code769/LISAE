<?php ob_start(); ?>
<h1>LISAE - ELOCE</h1>

    <?php while ($data = $posts->fetch()) { ?>
            <div class="news">
                <p>
                    <?= nl2br(htmlspecialchars($data['content'])) ?>
                </p>
            </div>
    <?php
            }
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>