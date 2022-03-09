<?php require VIEW_DIR . 'layout/header.php'; ?>
<?php
// echo '<pre>';
// print_r($data['articles']);
// echo '</pre>';
?>
<?php foreach ($data['articles'] as $article) : ?>
    <p><a href="/articles/<?= $article->slug ?>"><?= $article->slug ?></a></p>
    <p><?= $article->id ?></p>
    <p><?= $article->title ?></p>
    <p><?= $article->image ?></p>
    <p><?= $article->description ?></p>
    <hr>
<?php endforeach; ?>

<?php require VIEW_DIR . 'layout/footer.php'; ?>