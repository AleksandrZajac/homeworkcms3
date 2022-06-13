<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container admin-user-roles">
    <div class="row">
        <div class="col-md-12 blog-main">
            <div class="message"></div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $value) : ?>
                        <tr>
                            <th scope="row"><?= $value->id ?></th>
                            <td><?= $value->email ?></td>
                            <td><?= $value->name ?></td>
                            <td>
                                <select class="custom-select custom-select-lg mb-3 select-role-id" data-id="<?= $value->id ?>">
                                    <option value="1" <?= $value->role_name == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="2" <?= $value->role_name == 'moderator' ? 'selected' : '' ?>>Moderator</option>
                                    <option value="3" <?= $value->role_name == 'auth_user' ? 'selected' : '' ?>>User</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation" class="pt-3">
                <ul class="pagination">
                    <?php if ($data['pages'] > 1) : ?>
                        <?php for ($i = 1; $i < $data['pages'] + 1; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>&itemsOnPage=<?= $data['itemsOnPage'] ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ul>
            </nav>
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