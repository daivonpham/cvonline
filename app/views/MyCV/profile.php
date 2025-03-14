<main>
    <div class="container">
        <div class="card mb-4 mt-3">
            <form action="/profile" id="formAccountSettings" method="POST" enctype="multipart/form-data">

                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="<?= isset($profile['avatar']) ? '../images/avatar/' . $profile['avatar'] : '../assets/img/avatars/1.png' ?>"
                            id="image-preview" alt="user-avatar" class="d-block rounded avatar-custom" width="100"
                            id="uploadedAvatar">
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Chọn ảnh mới</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden="" name="avatar"
                                    accept="image/png, image/jpeg">
                            </label>

                            <p class="text-muted mb-0">Chỉ cho phép các định dạng JPG, GIF hoặc PNG. Dung lượng tối đa:
                                2MB.</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Họ và tên</label>
                            <span class="icon-required">*</span>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Daivon Pham"
                                autofocus="" value="<?= $profile['fullname'] ?? '' ?>">
                            <span class="text-danger"><?= !empty($errors['name']) ? reset($errors['name']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nickname" class="form-label">Chức danh</label>
                            <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Daivon"
                                value="<?= $profile['nickname'] ?? '' ?>">
                            <span
                                class="text-danger"><?= !empty($errors['nickname']) ? reset($errors['nickname']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="birthday" class="form-label">Ngày sinh</label>
                            <span class="icon-required">*</span>
                            <input class="form-control" type="date" id="birthday" name="birthday"
                                placeholder="30/12/2000" autofocus="" value="<?= $profile['birthday'] ?? '' ?>">
                            <span
                                class="text-danger"><?= !empty($errors['birthday']) ? reset($errors['birthday']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="sex" class="form-label">Giới tính</label>
                            <span class="icon-required">*</span>
                            <select id="sex" class="form-select" name="gender">
                                <option value="male" <?= ($profile['gender'] ?? '') == 'male' ? 'selected' : '' ?>>Nam
                                </option>
                                <option value="female" <?= ($profile['gender'] ?? '') == 'female' ? 'selected' : '' ?>>Nữ
                                </option>
                                <option value="other" <?= ($profile['gender'] ?? '') == 'other' ? 'selected' : '' ?>>Giới
                                    tính khác</option>
                            </select>
                            <span
                                class="text-danger"><?= !empty($errors['gender']) ? reset($errors['email']) : ''; ?></span>

                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <span class="icon-required">*</span>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">VN (+84)</span>
                                <input type="number" id="phone" name="phone" class="form-control"
                                    value="<?= $profile['phone'] ?? '' ?>" placeholder="123456789">

                            </div>
                            <span
                                class="text-danger"><?= !empty($errors['phone']) ? reset($errors['phone']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <span class="icon-required">*</span>
                            <input type="text" class="form-control" id="address" name="address"
                               value="<?= $profile['address'] ?? '' ?>" 
                                placeholder="122 Nguyễn Huệ, Phường 1, Quận 1, TP.HCM">
                            <span
                                class="text-danger"><?= !empty($errors['address']) ? reset($errors['address']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website"
                            value="<?= $profile['website'] ?? '' ?>" 
                                placeholder="https://example.com">
                            <span
                                class="text-danger"><?= !empty($errors['website']) ? reset($errors['website']) : ''; ?></span>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Chuyên ngành</label>
                            <span class="icon-required">*</span>
                            <input class="form-control" type="text" id="major" name="major"
                            value="<?= $profile['major'] ?? '' ?>" 
                                placeholder="Backend Developer">
                            <span
                                class="text-danger"><?= !empty($errors['major']) ? reset($errors['major']) : ''; ?></span>

                        </div>

                        <!-- /Account -->
                        <div>
                            <h5 class="card-header">Kết nối mạng xã hội</h5>
                            <div class="card-body row">
                                <p>Nhập liên kết tài khoản của bạn:</p>

                                <!--Zalo -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/zalo.png" alt="zalo"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="zalo-check"
                                                onchange="toggleInput('zalo-link', this)" <?= isset($socialLinks['zalo_link']) ? 'checked' : '' ?>>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="zalo-link"
                                       style="display: <?= !empty($socialLinks['zalo_link']) ? 'block' : 'none' ?>;">

                                        <input type="url" name="zalo_link" class="form-control w-input"
                                            value="<?= $socialLinks['zalo_link'] ?? '' ?>"
                                            placeholder="Nhập liên kết zalo" />
                                    </div>
                                </div>
                                

                                <!--facebook -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/facebook.png" alt="facebook"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="facebook-check"
                                                onchange="toggleInput('facebook-link', this)" <?= isset($socialLinks['facebook_link']) ? 'checked' : '' ?>>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="facebook-link"
                                       style="display: <?= !empty($socialLinks['facebook_link']) ? 'block' : 'none' ?>;">

                                        <input type="url" name="facebook_link" class="form-control w-input"
                                            value="<?= $socialLinks['facebook_link'] ?? '' ?>"
                                            placeholder="Nhập liên kết facebook" />
                                    </div>
                                </div>

                                <!--instagram -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/instagram.png" alt="instagram"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="instagram-check"
                                                onchange="toggleInput('instagram-link', this)" <?= isset($socialLinks['instagram_link']) ? 'checked' : '' ?>>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="instagram-link"
                                       style="display: <?= !empty($socialLinks['instagram_link']) ? 'block' : 'none' ?>;">

                                        <input type="url" name="instagram_link" class="form-control w-input"
                                            value="<?= $socialLinks['instagram_link'] ?? '' ?>"
                                            placeholder="Nhập liên kết instagram" />
                                    </div>
                                </div>
                                

                                <!--Twitter -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/twitter.png" alt="twitter"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="twitter-check"
                                                onchange="toggleInput('twitter-link', this)" <?= isset($socialLinks['twitter_link']) ? 'checked' : '' ?>>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="twitter-link"
                                       style="display: <?= !empty($socialLinks['twitter_link']) ? 'block' : 'none' ?>;">

                                        <input type="url" name="twitter_link" class="form-control w-input"
                                            value="<?= $socialLinks['twitter_link'] ?? '' ?>"
                                            placeholder="Nhập liên kết twitter" />
                                    </div>
                                </div>

                                <!-- Github -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/github.png" alt="github"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="github-check"
                                                onchange="toggleInput('github-link', this)" <?= isset($socialLinks['github_link']) ? 'checked' : '' ?>>
                                
                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="github-link"
                                        style="display: <?= !empty($socialLinks['github_link']) ? 'block' : 'none' ?>;">
                                
                                        <input type="url" name="github_link" class="form-control w-input"
                                            value="<?= $socialLinks['github_link'] ?? '' ?>" placeholder="Nhập liên kết github" />
                                    </div>
                                </div>

                                <!-- Slack -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/slack.png" alt="slack"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="slack-check"
                                                onchange="toggleInput('slack-link', this)" <?= isset($socialLinks['slack_link']) ? 'checked' : '' ?>>
                                
                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="slack-link"
                                        style="display: <?= !empty($socialLinks['slack_link']) ? 'block' : 'none' ?>;">
                                
                                        <input type="url" name="slack_link" class="form-control w-input"
                                            value="<?= $socialLinks['slack_link'] ?? '' ?>" placeholder="Nhập liên kết slack" />
                                    </div>
                                </div>

                                <!-- Discord -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/discord.png" alt="discord"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="discord-check"
                                                onchange="toggleInput('discord-link', this)" <?= isset($socialLinks['discord_link']) ? 'checked' : '' ?>>
                                
                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="discord-link"
                                        style="display: <?= !empty($socialLinks['discord_link']) ? 'block' : 'none' ?>;">
                                
                                        <input type="url" name="discord_link" class="form-control w-input"
                                            value="<?= $socialLinks['discord_link'] ?? '' ?>" placeholder="Nhập liên kết discord" />
                                    </div>
                                </div>

                                <!-- Telegram -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/telegram.png" alt="telegram"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="telegram-check"
                                                onchange="toggleInput('telegram-link', this)" <?= isset($socialLinks['telegram_link']) ? 'checked' : '' ?>>
                                
                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="telegram-link"
                                        style="display: <?= !empty($socialLinks['telegram_link']) ? 'block' : 'none' ?>;">
                                
                                        <input type="url" name="telegram_link" class="form-control w-input"
                                            value="<?= $socialLinks['telegram_link'] ?? '' ?>" placeholder="Nhập liên kết telegram" />
                                    </div>
                                </div>

                                <!-- Tiktok -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/tiktok.png" alt="tiktok"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="tiktok-check"
                                                onchange="toggleInput('tiktok-link', this)" <?= isset($socialLinks['tiktok_link']) ? 'checked' : '' ?>>

                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="tiktok-link"
                                       style="display: <?= !empty($socialLinks['tiktok_link']) ? 'block' : 'none' ?>;">

                                        <input type="url" name="tiktok_link" class="form-control w-input"
                                            value="<?= $socialLinks['tiktok_link'] ?? '' ?>"
                                            placeholder="Nhập liên kết tiktok" />
                                    </div>
                                </div>

                                <!-- Youtube -->
                                <div class="d-flex mb-3 col-md-6 h-39">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/img/icons/brands/youtube.png" alt="youtube"
                                            class="me-3 logo-connect">

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="youtube-check"
                                                onchange="toggleInput('youtube-link', this)" <?= isset($socialLinks['youtube_link']) ? 'checked' : '' ?>>
                                
                                        </div>
                                    </div>
                                    <div class="flex-grow-1" id="youtube-link"
                                        style="display: <?= !empty($socialLinks['youtube_link']) ? 'block' : 'none' ?>;">
                                
                                        <input type="url" name="youtube_link" class="form-control w-input"
                                            value="<?= $socialLinks['youtube_link'] ?? '' ?>" placeholder="Nhập liên kết youtube" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 ">
                            <button type="submit" class="btn btn-info me-2 float-right">Lưu Hồ Sơ</button>
                        </div>
                    </div>
            </form>
        </div>


    </div>
    </div>
</main>

<script>
    const input = document.getElementById('upload');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function () {
            const result = reader.result;
            preview.src = result;
        }
        reader.readAsDataURL(file);
    }
    );

    function toggleInput(inputId, checkbox) {
        var inputField = document.getElementById(inputId);
        if (checkbox.checked) {
            inputField.style.display = 'block'; // Hiển thị input khi checkbox được check
        } else {
            inputField.style.display = 'none'; // Ẩn input khi checkbox không được check
        }
    }


</script>