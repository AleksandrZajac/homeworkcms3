<?php require VIEW_DIR . 'layout/header.php'; ?>
<?php
// echo '<pre>';
// print_r($data['article']);
// echo '</pre>';
?>
<p><?= $data['article']->slug ?></p>
<p><?= $data['article']->title ?></p>
<p><?= $data['article']->image ?></p>
<p><?= $data['article']->description ?></p>
<hr>
<a href="">Обновить статью</a>
<?php require VIEW_DIR . 'layout/footer.php'; ?>