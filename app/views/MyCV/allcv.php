<main>
    <div class="container-xxl row container-p-y focus flex gap-3">

        <?php if (isset($cv) && !empty($cv)): ?>
            <?php foreach ($cv as $item): ?>
                <div class="col-md-6 col-lg-4 mb-3 allcv">
                    <div class="card text-center">
                        <div class=" text-center">
                            <img class="img-cv" src="images/templates_cv/<?php echo htmlspecialchars($item['theme']) ?>"
                                alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']) ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['fullname']) ?> -
                                <?php echo htmlspecialchars($item['major']) ?></p>
                            <a href="/editcv/<?php echo htmlspecialchars($item['cv_id']) ?>" class="btn btn-primary">Chỉnh
                                sửa</a>
                            <a href="/deletecv/<?php echo htmlspecialchars($item['cv_id']) ?>" class="btn btn-danger">Xóa</a>
                        </div>
                        <div class="card-footer text-muted"><?php echo calculateTimeAgo($item['update_at']); ?></div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>

    </div>

</main>