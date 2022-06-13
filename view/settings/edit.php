<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container admin-subscribes">
    <?php if (isset($data['errors'])) : ?>
        <?php foreach ($data['errors'] as $key => $value) : ?>
            <p class="text-danger"><?= $value ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12 blog-main">
            <h4>Количесво статей на главной странице</h4>
            <form class="form-inline mb-5 mt-3" method="POST" action="/admin/settings/edit">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputItems" class="sr-only">Штук</label>
                    <input type="text" class="form-control" id="inputItems" placeholder="Штук" name="items" value="<?= $data['items'] ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
            </form>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>