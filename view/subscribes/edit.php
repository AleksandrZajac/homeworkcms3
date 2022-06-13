<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container admin-subscribes">
    <div class="row">
        <div class="col-md-12 blog-main">
            <?php if (isset($_SESSION['errors'])) : ?>
                <?php foreach ($_SESSION['errors'] as $value) : ?>
                    <p class="text-danger"><?= $value ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php
            if (isset($_SESSION['errors'])) {
                unset($_SESSION['errors']);
            }
            ?>
            <?php if (isset($_SESSION['success'])) : ?>
                <p class="alert alert-success"><?= $_SESSION['success'] ?></p>
            <?php endif; ?>
            <?php
            if (isset($_SESSION['success'])) {
                unset($_SESSION['success']);
            }
            ?>
            <?php if (isset($data['errors'])) : ?>
                <?php foreach ($data['errors'] as $key => $value) : ?>
                    <p class="text-danger"><?= $value ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <form method="POST" class="form-inline" id="loginform" action="/admin/subscribes/create">
                <p class="message">Подписка на статьи:</p>
                <div class=" form-group mx-sm-3 mb-2">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Емайл" name="email">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Подписка</button>
            </form>
            <div class="message"></div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">created_at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['subscribes'] as $key => $value) : ?>
                        <tr id="subscribe-row-<?= $key ?>">
                            <th scope="row"><?= $value->email ?></th>
                            <td><?= $value->created_at ?></td>
                            <td>
                                <form method="POST" action="/admin/subscribes/<?= $value->id ?>/delete">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Стереть</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

<?php require VIEW_DIR . 'layout/footer.php'; ?>