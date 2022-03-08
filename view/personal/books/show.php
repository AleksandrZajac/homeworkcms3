<?php require VIEW_DIR . 'layout/header.php';?>

<?php foreach ($data['books'] as $book): ?>
<p><?=$book->name?></p>
<?php endforeach;?>

<?php require VIEW_DIR . 'layout/footer.php';?>
