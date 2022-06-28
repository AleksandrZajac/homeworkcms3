<?php require VIEW_DIR . 'layout/header.php'; ?>

<title>Личный кабинет</title>
<div class="container profile-page">
    <p>Личный кабинет</p>
    <div class="row">
        <div class="col-sm-6">
            <div class="border mr-1">
                <?php if (isset($data['errors'])) : ?>
                    <?php foreach ($data['errors'] as $key => $value) : ?>
                        <p class="text-danger"><?= $value ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <form method="POST" action="/user/id/<?= $data['old']->id ?>" enctype="multipart/form-data">
                    <div class="m-3">
                        <img class="avatar rounded-circle" src="<?= $data['avatar'] ?>" alt="Фото">
                    </div>
                    <div class="m-3">
                        <strong>Аватар:</strong>
                        <input type="file" name="avatar" class="form-control" id="avatar">
                    </div>
                    <div class="mb-3 m-3">
                        <label for="annotation">О себе</label>
                        <textarea class="form-control" id="annotation" name="annotation"><?= $data['old']['annotation'] ?? null; ?>
                    </textarea>
                    </div>
                    <div class="container pt-3 pb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Редактировать профиль</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="border ml-1 p-2">
                <form method="POST" class="form-inline" id="subscribeProfileForm">
                    <p class="message">Подписка на статьи:</p>
                    <div class=" form-group mx-sm-3 mb-2">
                        <label for="email" class="sr-only">Email</label>
                        <input type="hidden" class="form-control" id="email" placeholder="Емайл" name="email" value="<?= $_SESSION['login'] ?>">
                    </div>
                    <button type="button" id="submitBtn" class="btn btn-primary mb-2" data-subscribe="<?= $_SESSION['subscribe'] ? "Отписка" : "Подписка" ?>"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_DIR . 'layout/footer.php'; ?>