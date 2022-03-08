<?php require VIEW_DIR . 'layout/header.php'; ?>

<?php foreach ($data['articles'] as $article) : ?>
    <p><a href="/articles/yrtydr"><?= $article->slug ?></a></p>
    <p><?= $article->title ?></p>
    <p><?= $article->image ?></p>
    <p><?= $article->description ?></p>
    <hr>
<?php endforeach; ?>

<?php require VIEW_DIR . 'layout/footer.php'; ?>