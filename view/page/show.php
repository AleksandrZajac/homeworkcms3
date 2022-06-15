<?php require VIEW_DIR . 'layout/header.php'; ?>

<title>Страница</title>
<div class="album py-5 bg-light index-page">
    <div class="container">
        <div class="row">
            <div class="pt-4 pb-5 col-10 offset-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title"><?= $data['page']->title ?></h4>
                        <p class="card-text"><?= $data['page']->description ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if ($_SESSION['is_admin'] || $_SESSION['is_moderator']) : ?>
                                <div class="btn-group">
                                    <a href="/static_page/<?= $data['page']->slug ?>/edit" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                    <form method="POST" action="/page/<?= $data['page']->slug ?? null; ?>/delete">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить страницу</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>