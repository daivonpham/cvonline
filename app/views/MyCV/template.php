<main>
    <form action="/updateTemplateCV" method="POST">
        <div class="container">
            <div class="mb-3 mt-3">
                <select id="defaultSelect" name="cv_id" class="form-select">
                    <option value="">Chọn CV cần thay đổi giao diện</option>
                    <?php if (isset($namecv) && !empty($namecv)): ?>
                        <?php foreach ($namecv as $cv): ?>
                            <option value="<?php echo htmlspecialchars($cv['cv_id']); ?>"
                                <?php echo (isset($oldData['cv_id']) && $oldData['cv_id'] == $cv['cv_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cv['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger font-bold ml-4"><?= !empty($errors['cv_id']) ? reset($errors['cv_id']) : ''; ?></span>
            </div>
        </div>

        <div class="container">
            <div class="row container-p-y focus gap-0.5 justify-center">
                <?php if (isset($templates) && !empty($templates)): ?>
                    <?php foreach ($templates as $item): ?>
                        <div class="col-md-6 col-lg-4 mb-3 w-701 click-item">
                            <label class="card card-label">
                                <div class="card text-center">
                                    <div class="p-3 size-image-template">
                                        <img class="img-cv"
                                            src="images/templates_cv/<?php echo htmlspecialchars($item['theme']); ?>"
                                            alt="<?php echo htmlspecialchars($item['path']); ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                        <input type="radio" name="template_id" value="<?php echo htmlspecialchars($item['template_id']); ?>"
                                            <?php echo (isset($oldData['template_id']) && $oldData['template_id'] == $item['template_id']) ? 'checked' : ''; ?>>
                                        <i class="fa-regular fa-eye"></i>
                                        <a href="/preview/<?php echo htmlspecialchars($item['template_id']); ?>" class="btn btn-primary view-template">Xem trước</a>
                                    </div>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="container">
                    <button type="submit" class="btn btn-info float-right color-white">Lưu giao diện</button>
                </div>
            </div>
        </div>
    </form>
</main>

<style>
    .click-item {
        border-radius: 8px;
        cursor: pointer;
    }
    .click-item.selected > .card{
        border: solid 1px #696cff;
        background-color: #fcfaff;
        position: relative;
    }
    .click-item input[type="radio"] {
        display: none; 
    }
</style>

<script>
    const items = document.querySelectorAll('.click-item');

    items.forEach(item => {
        item.addEventListener('click', () => {
            items.forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
        });
    });

</script>