<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">Создать страницу</h2>
                <?php if (isset($data['errors'])) : ?>
                    <?php foreach ($data['errors'] as $key => $value) : ?>
                        <p class="text-danger"><?= $value ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <form method="POST" action="/static_page/create">
                    <div class="form-group">
                        <label for="slug">Символьный код</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="<?= $data['old']['slug'] ?? null; ?>">
                    </div>
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" name="title" id="articleName" value="<?= $data['old']['title'] ?? null; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Статья</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Содержание статьи" rows="8" cols="60"><?= $data['old']['description'] ?? null; ?></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input name="is_published" type="hidden" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" <?= !empty($data['old']['is_published']) ? 'checked' : null; ?>>
                        <label for="is_published">Опубликовать</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>