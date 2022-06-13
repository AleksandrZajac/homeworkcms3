<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="pt-4 pb-5 col-3 offset-4">
            <?php if (isset($data['errors'])) : ?>
                <?php foreach ($data['errors'] as $key => $value) : ?>
                    <p class="text-danger"><?= $value ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="/login/check" method="POST">
                <div class="mb-3">
                    <label for="email" class="">Емайл</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $data['old']['email'] ?? null; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $data['old']['password'] ?? null; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>