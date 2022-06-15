<?php require VIEW_DIR . 'layout/header.php'; ?>
<div class="album py-5 bg-light index-page">
    <div class="container">
        <?php if (isset($_SESSION['success'])) : ?>
            <p class="alert alert-success"><?= $_SESSION['success'] ?></p>
        <?php endif; ?>
        <?php
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        ?>
        <title>Статьи</title>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($data['articles'] as $article) : ?>
                <div class="col-4 pt-2 w-100 h-100">
                    <div class="card shadow-sm">
                        <img src="<?= $article->image ?>" alt="Card image">

                        <div class="card-body">
                            <h4 class="card-title"><?= $article->title ?></h4>
                            <p class="card-text"><?= $article->short_description ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/articles/<?= $article->slug ?>" class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                </div>
                                <small class="text-muted"><?= $article->updated_at ?></small>
                            </div>
                            <?php if ($_SESSION['is_admin'] || $_SESSION['is_moderator']) : ?>
                                <p class="card-text"><?= $article->is_published ? 'Опубликована' : 'Не опубликована'; ?></p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation" class="pt-3">
            <ul class="pagination">
                <?php if ($data['pages'] > 1) : ?>
                    <?php for ($i = 1; $i < $data['pages'] + 1; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if (!isset($_SESSION['login'])) : ?>
            <form method="POST" class="form-inline" id="loginform">
                <p class="message">Подписка на статьи:</p>
                <div class=" form-group mx-sm-3 mb-2">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Емайл" name="email">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Подписка</button>
            </form>
        <?php elseif (isset($_SESSION['login']) && !$_SESSION['subscribe']) : ?>
            <form method="POST" class="form-inline" id="loginform">
                <p class="message">Подписка на статьи:</p>
                <div class=" form-group mx-sm-3 mb-2">
                    <label for="email" class="sr-only">Email</label>
                    <input type="hidden" class="form-control" id="email" placeholder="Емайл" name="email" value="<?= $_SESSION['login'] ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Подписка</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>