<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="pt-4 pb-5 col-6 offset-3">
            <?php if ($data['article']->is_published) : ?>
                <div class="card shadow-sm">
                    <img src="<?= $data['article']->image ?>" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title"><?= $data['article']->title ?></h4>
                        <p class="card-text"><?= $data['article']->description ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if ($_SESSION['is_admin'] || $_SESSION['is_moderator']) : ?>
                                <div class="btn-group">
                                    <a href="/admin/articles/<?= $data['article']->slug ?>/edit" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                    <form method="POST" action="/admin/articles/<?= $data['article']->slug ?? null; ?>/delete">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Стереть задачу</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <small class="text-muted"><?= $data['article']->updated_at ?></small>
                        </div>
                    </div>
                    <div class="m-3">
                        <hr>
                        <form method="POST" action="/articles/<?= $data['article']->slug ?>">
                            <div class="mb-3">
                                <label for="description">Добавить коментарий</label>
                                <?php if (isset($data['errors'])) : ?>
                                    <?php foreach ($data['errors'] as $key => $value) : ?>
                                        <p class="text-danger"><?= $value ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <textarea class="form-control" id="description" name="description" placeholder="Ваш коментарий" rows="4" cols="60"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary  mt-3">Отправить</button>
                        </form>
                        <hr>
                        <h4 class="card-title">Коментарии</h4>
                        <?php foreach ($data['comments'] as $value) : ?>
                            <hr>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $value->user_id || $value->status == $data['statuses']['allowed']) : ?>
                                <img src="<?= $value->avatar ?>" class="rounded w-25" alt="Card image">
                                <p><?= $value->name ?></p>
                                <p class="alert-warning"><?= $value->status ==  $data['statuses']['moderation'] ? 'Комментарий на модерации' : ''; ?></p>
                                <p class="alert-danger"><?= $value->status == $data['statuses']['rejected'] ? 'Комментарий отклонен' : ''; ?></p>
                                <p><?= $value->description ?></p>
                                <p><?= $value->updated_at ?></p>
                            <?php elseif (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['roles']['admin']) : ?>
                                <img src="<?= $value->avatar ?>" class="rounded w-25" alt="Card image">
                                <p><?= $value->name ?></p>
                                <p><?= $value->description ?></p>
                                <p><?= $value->updated_at ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                </div>
            <?php else : ?>
                <h4>Запрашиваемая страница не существует</h4>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>