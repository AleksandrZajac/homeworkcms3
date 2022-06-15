<?php require VIEW_DIR . 'layout/header.php'; ?>

<title>Статические страницы</title>
<div class="album py-5 bg-light index-page">
    <div class="container admin-pages">
        <div class="row">
            <?php foreach ($data['staticPages'] as $page) : ?>
                <div class="col-4 pt-2 w-100 h-100">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><?= $page->title ?></h4>
                            <p class="card-text"><?= $page->short_description ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/page/<?= $page->slug ?>" class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                </div>
                                <small class="text-muted"><?= $page->updated_at ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="p-1">
            <?php if ($data['pages'] > 1) : ?>
                <nav aria-label="Page navigation" class="pt-3">
                    <ul class="pagination">
                        <?php for ($i = 1; $i < $data['pages'] + 1; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>&itemsOnPage=<?= $data['itemsOnPage'] ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-auto">
                <form method="GET">
                    <select class="custom-select items-on-page custom-select-lg mb-3" name="itemsOnPage">
                        <option value="10" <?= $data['itemsOnPage'] == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $data['itemsOnPage'] == 20 ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $data['itemsOnPage'] == 50 ? 'selected' : '' ?>>50</option>
                        <option value="200" <?= $data['itemsOnPage'] == 200 ? 'selected' : '' ?>>200</option>
                        <option value="0" <?= $data['itemsOnPage'] == 0 ? 'selected' : '' ?>>Все</option>
                    </select>
                    <button type="submit" class="admin-pagination-button" hidden>send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>