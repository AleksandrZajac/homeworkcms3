<?php require VIEW_DIR . 'layout/header.php'; ?>

<div class="container admin-comments">
    <div class="row">
        <div class="col-md-12 blog-main">
            <div class="message"></div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Comment</th>
                        <th scope="col">created_at</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['comments'] as $value) : ?>
                        <tr>
                            <th scope="row"><?= $value->email ?></th>
                            <td><?= $value->description ?></td>
                            <td><?= $value->created_at ?></td>
                            <td>
                                <select class="custom-select custom-select-lg mb-3 select-status" data-id="<?= $value->id ?>">
                                    <option value="1" <?= $value->status == $data['statuses']['allowed'] ? 'selected' : '' ?>>Разрешено</option>
                                    <option value="2" <?= $value->status == $data['statuses']['rejected'] ? 'selected' : '' ?>>Отклонено</option>
                                    <option value="3" <?= $value->status == $data['statuses']['moderation'] ? 'selected' : '' ?>>На модерации</option>
                                </select>
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