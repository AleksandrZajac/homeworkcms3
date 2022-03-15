<?php require VIEW_DIR . 'layout/header.php'; ?>
<p>Create article</p>
<form method="POST" action="/">
    <div class="mb-3">
        <label for="articleSlug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug">
    </div>
    <div class="mb-3">
        <label for="articleTitle" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="articleImage" class="form-label">Image</label>
        <input type="text" class="form-control" id="image" name="image">
    </div>
    <div class="mb-3">
        <label for="description">Детальное описание статьи</label>
        <textarea class="form-control" id="description" name="description">
        </textarea>
    </div>
    <div class="mb-3">
        <input name="is_published" type="hidden" value="0">
        <input type="checkbox" id="isPublished" name="is_published" value="1">
        <label for="isPublished">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php require VIEW_DIR . 'layout/footer.php'; ?>