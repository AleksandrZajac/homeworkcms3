<div class="container">
    <div class="row justify-content-md-center">
        <div class="nav-scroller col-md-12 py-1 mb-2 text-center">
            <ul class="nav nav-pills">
                <?php if ($_SESSION['is_admin'] || $_SESSION['is_moderator']) : ?>
                    <li class="nav-item"><a href="/admin/articles" class="nav-link">Статьи</a></li>
                    <li class="nav-item"><a href="/admin/articles/create" class="nav-link">Создать статью</a></li>
                    <li class="nav-item"><a href="/static_page/create" class="nav-link">Создать страницу</a></li>
                    <li class="nav-item"><a href="/pages" class="nav-link" aria-current="page">Статические страницы</a></li>
                    <li class="nav-item"><a href="/admin/comments" class="nav-link" aria-current="page">Комментарии</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['is_admin']) : ?>
                    <li class="nav-item"><a href="/admin/user/role" class="nav-link" aria-current="page">Пользователи</a></li>
                    <li class="nav-item"><a href="/admin/subscribes" class="nav-link" aria-current="page">Подписки</a></li>
                    <li class="nav-item"><a href="/admin/settings" class="nav-link" aria-current="page">Настройки</a></li>
                <?php endif; ?>
            </ul>
            <hr>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/" class="nav-link" aria-current="page">Статьи</a></li>
                <?php foreach ($_SESSION['pages'] as $page) : ?>
                    <?php if ($page->is_published) : ?>
                        <li class="nav-item"><a href="/page/<?= $page->slug ?>" class="nav-link"><?= $page->title ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!isset($_SESSION['login'])) : ?>
                    <li class="nav-item"><a class="btn btn-outline-secondary" href="/login/form">Login</a></li>
                    <li class="nav-item"><a class="btn btn-outline-secondary" href="/register/form">Register</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="btn btn-outline-secondary" href="/user/id/<?= $_SESSION['user_id'] ?>"><?= $_SESSION['login'] ?></a></li>
                    <li class="nav-item"><a class="btn btn-outline-secondary" href="/logout">Logout</a></li>
                <?php endif; ?>
            </ul>
            <hr>
        </div>
    </div>
</div>