<?php require VIEW_DIR . 'layout/header.php'; ?>

<title>Создать статью</title>
<div class="container">
    <p>Создать статью</p>
    <?php if (isset($data['errors'])) : ?>
        <?php foreach ($data['errors'] as $key => $value) : ?>
            <p class="text-danger"><?= $value ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form method="POST" action="/admin/articles/create" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="articleSlug" class="form-label">Слаг</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= $data['old']['slug'] ?? null; ?>">
        </div>
        <div class="mb-3">
            <label for="articleTitle" class="form-label">Название статьи</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $data['old']['title'] ?? null; ?>">
        </div>
        <div class="mb-3">
            <strong>Image:</strong>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="mb-3">
            <label for="description">Детальное описание статьи</label>
            <textarea class="form-control" id="description" name="description" placeholder="Содержание статьи" rows="8" cols="60"><?= $data['old']['description'] ?? null; ?></textarea>
        </div>
        <div class="mb-3">
            <input name="is_published" type="hidden" value="0">
            <input type="checkbox" id="isPublished" name="is_published" value="1" <?= !empty($data['old']['is_published']) ? 'checked' : null; ?>>
            <label for="isPublished">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>