<?php require VIEW_DIR . 'layout/header.php'; ?>
<?php
// echo '<pre>';
// print_r($data['articles']);
// echo '</pre>';
// echo $data['success'];
?>
<?php if (!empty($data['success'])) : ?>
    <p><?= $data['success'] ?></p>
<?php endif; ?>
<?php foreach ($data['articles'] as $article) : ?>
    <p><a href="/articles/<?= $article->slug ?>"><?= $article->slug ?></a></p>
    <p><?= $article->id ?></p>
    <p><?= $article->title ?></p>
    <img class="image" src="<?= $article->image ?>" alt="Photo">
    <p><?= $article->description ?></p>
    <hr>
<?php endforeach; ?>

<?php require VIEW_DIR . 'layout/footer.php'; ?>