<?php require APPROOT . "/views/inc/header.php"; ?>

    <a href="<?= URLROOT ?>/posts" class="btn btn-light">Back</a>

    <br>

    <h1><?= $data['post']->title ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?= $data['user']->name ?> on <?= $data['post']->created_at ?>
    </div>
    <p><?= $data['post']->body ?></p>

    <?php if($data['post']->user_id == $_SESSION['user_id']): ?>
        <hr>
        <div class="d-flex">
            <a href="<?= URLROOT ?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-dark">Edit</a>

            <form class="ms-auto" action="<?= URLROOT ?>/posts/delete/<?= $data['post']->id ?>" method="POST">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
    <?php endif; ?>

<?php require APPROOT . "/views/inc/footer.php"; ?>
