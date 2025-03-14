<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Professional Resume - <?= htmlspecialchars($data['cv']['name'] ?? 'CV') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 min-h-screen p-6 antialiased">
    <div class="max-w-5xl mx-auto backdrop-blur-lg bg-white/80 rounded-3xl shadow-2xl overflow-hidden">
        <header class="relative h-40 bg-gradient-to-r from-blue-600 to-purple-600 p-8">
            <div class="absolute -bottom-20 left-10 flex items-end gap-8">
                <img src="<?= isset($data['cv']['avatar']) ? '/images/avatar/' . htmlspecialchars($data['cv']['avatar']) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9' ?>"
                    alt="Profile Photo"
                    class="w-40 h-[200px] mt-[30px] rounded-full object-cover border-4 border-white shadow-xl">
                <div class="mb-14 text-white">
                    <h1 class="text-5xl font-bold mb-1"><?= htmlspecialchars($data['cv']['fullname'] ?? '') ?></h1>
                    <p class="text-xl font-medium text-gray-800">
                        <?= htmlspecialchars($data['cv']['major'] ?? 'Senior Software Engineer') ?>
                    </p>
                </div>
            </div>
        </header>

        <main class="mt-24 p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <?php if (!empty($data['cv']['name'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-bullseye text-blue-600 text-xl"></i>Mục tiêu nghề nghiệp
                        </h2>
                        <p class="text-gray-600 leading-relaxed"><?= nl2br(htmlspecialchars($data['cv']['target'] ?? '')) ?></p>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['work_experience'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-briefcase text-blue-600"></i>Kinh nghiệm làm việc
                        </h2>
                        <div class="space-y-6">
                            <?php foreach ($data['work_experience'] as $work): ?>
                                <div class="relative pl-6 border-l-2 border-blue-600">
                                    <div class="absolute w-3 h-3 bg-blue-600 rounded-full -left-[7px] top-2"></div>
                                    <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($work['position'] ?? '') ?>
                                    </h3>
                                    <p class="text-blue-600"><?= htmlspecialchars($work['company'] ?? '') ?> |
                                        <?= formatDateToVietnamese($work['start_date'] ?? '') ?> -
                                        <?= formatDateToVietnamese($work['end_date'] ?? 'Present') ?>
                                    </p>

                                    <?= formatDescription($work['description'] ?? '') ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['education'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-blue-600"></i>Học vấn
                        </h2>
                        <?php foreach ($data['education'] as $edu): ?>
                            <div class="pl-6 border-l-2 border-blue-600 relative">
                                <div class="absolute w-3 h-3 bg-blue-600 rounded-full -left-[7px] top-2"></div>
                                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($edu['major'] ?? '') ?></h3>
                                <p class="text-blue-600"><?= htmlspecialchars($edu['school'] ?? '') ?> |
                                    <?= htmlspecialchars($edu['start_date'] ?? '') ?> -
                                    <?= htmlspecialchars($edu['end_date'] ?? '') ?>
                                </p>
                                <p class="text-gray-600 mt-2"><?= htmlspecialchars($edu['achievements'] ?? '') ?></p>
                            </div>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['projects'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-project-diagram text-blue-600"></i>Dự án
                        </h2>
                        <?php foreach ($data['projects'] as $project): ?>

                            <div>
                                <div class="bg-white/50 rounded-xl p-6 border border-blue-100 mt-2">
                                    <h3 class="text-xl font-bold text-gray-800">
                                        <?= htmlspecialchars($project['name'] ?? '') ?>
                                    </h3>
                                    <div class="flex items-start gap-4 mt-4">
                                        <h3 class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                            <?= htmlspecialchars($project['position'] ?? '') ?></h3>
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><?= formatDateToVietnamese($project['start_date'] ?? '') ?>
                                            - <?= formatDateToVietnamese($project['end_date'] ?? 'Present') ?></span>
                                    </div>
                                    <?php if (!empty($project['team_num'])): ?>
                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-users text-blue-600"></i>
                                            <span class="text-gray-600">Số lượng thành viên:
                                                <?= htmlspecialchars($project['team_num'] ?? '') ?></span>
                                        </div>
                                    </div>
                                    <?php endif?>
                                    <?php if (!empty($project['tech'])): ?>
                                    <div class="mt-4">
                                        <h4 class="font-semibold text-gray-700">Công nghệ sử dụng:</h4>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <?= formatLangtech($project['tech']) ?>

                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if (!empty($project['role'])): ?>
                                    <div class="mt-4">
                                        <h4 class="font-semibold text-gray-700">Vai trò và nhiệm vụ:</h4>
                                        <ul class="mt-2 space-y-2">
                                            <?= formatDescription($project['role'] ?? '') ?>
                                           
                                        </ul>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </section>

                <?php endif; ?>
                
                <?php if(!empty($data['activities'])):?>
                <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-users text-blue-600"></i>Hoạt động
                    </h2>
                    <div class="space-y-4">
                        <?php foreach($data['activities'] as $item):?>
                        <div class="bg-white/50 rounded-xl p-4 border border-blue-100">
                            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($item['name'] ?? '') ?></h3>
                            <p class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm w-[100px]"><?= formatDateToVietnamese($item['date'] ?? '') ?></p>
                            <p class="text-gray-600 mt-2"><?= formatDescription($item['description'] ?? '') ?></p>
                        </div>   
                        <?php endforeach;?>                   
                    </div>
                </section>
                <?php endif;?>
            </div>

            <div class="space-y-8">
                <?php if (!empty($data['cv']['email']) || !empty($data['cv']['phone']) || !empty($data['cv']['address']) || !empty($data['cv']['website'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-address-card text-blue-600"></i>Liên hệ
                        </h2>
                        <div class="space-y-3">
                            <?php if (!empty($data['cv']['email'])): ?>
                                <p class="flex items-center gap-3 text-gray-600"><i
                                        class="fas fa-envelope text-blue-600"></i><?= htmlspecialchars($data['cv']['email']) ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($data['cv']['phone'])): ?>
                                <p class="flex items-center gap-3 text-gray-600"><i
                                        class="fas fa-phone text-blue-600"></i><?= htmlspecialchars($data['cv']['phone']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($data['cv']['address'])): ?>
                                <p class="flex items-center gap-3 text-gray-600"><i
                                        class="fas fa-map-marker-alt text-blue-600"></i><?= htmlspecialchars($data['cv']['address']) ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($data['cv']['website'])): ?>
                                <p class="flex items-center gap-3 text-gray-600"><i
                                        class="fas fa-globe text-blue-600"></i><?= htmlspecialchars($data['cv']['website']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['skills'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-code text-blue-600"></i>Kỹ năng
                        </h2>
                        <div class="space-y-4">
                            <?php
                            // Nhóm các kỹ năng theo name_skill
                            $groupedSkills = [];
                            foreach ($data['skills'] as $skill) {
                                $nameSkill = $skill['name_skill'] ?? 'Other';
                                if (!isset($groupedSkills[$nameSkill])) {
                                    $groupedSkills[$nameSkill] = [];
                                }
                                $groupedSkills[$nameSkill][] = $skill['skills'];
                            }
                            ?>
                
                            <?php foreach ($groupedSkills as $category => $skills): ?>
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2"><?= htmlspecialchars($category) ?>:</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach ($skills as $skill): ?>
                                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-sm">
                                                <?= htmlspecialchars($skill) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['language'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-language text-blue-600"></i>Ngôn ngữ
                        </h2>
                        <div class="space-y-3">
                            <?php foreach ($data['language'] as $lang): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600"><?= nl2br(formatData($lang['name'] ?? '')) ?></span>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($data['social_link'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-globe text-blue-600"></i>Mạng xã hội
                        </h2>
                        <div class="grid grid-cols-5 gap-4">
                <?php
                            $platformIcons = [
                                'Facebook' => 'fab fa-facebook',
                                'Instagram' => 'fab fa-instagram',
                                'Github' => 'fab fa-github',
                                'Slack' => 'fab fa-slack',
                                'Youtube' => 'fab fa-youtube',
                                'Telegram' => 'fab fa-telegram',
                                'Tiktok' => 'fab fa-tiktok',
                                'Discord' => 'fab fa-discord',
                                'Twitter' => 'fab fa-twitter',
                                'Zalo' => 'fas fa-comment' 
                            ];

                            foreach ($data['social_link'] as $social): 
                                $platform = $social['platform'] ?? '';
                                $icon = $platformIcons[$platform] ?? 'fas fa-link'; 
                            ?>
                                <a href="<?= htmlspecialchars($social['url']) ?>" 
                                   target="_blank"
                                   title="<?= htmlspecialchars($platform) ?>"
                                   class="text-gray-600 hover:text-blue-600 transition-colors text-xl flex items-center justify-center">
                                    <i class="<?= htmlspecialchars($icon) ?> text-xl"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php
                $hobbies = explode(',', $data['cv']['hobbies'] ?? '');
                $hasHobbies = false;
                foreach ($hobbies as $hobby) {
                    if (trim($hobby) !== '') {
                        $hasHobbies = true;
                        break;
                    }
                }
                if ($hasHobbies): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-heart text-blue-600"></i>Hobbies
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <?php foreach ($hobbies as $hobby): ?>
                                <?php if (trim($hobby) !== ''): ?>
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <i
                                            class="fas fa-<?= htmlspecialchars(getHobbyIcon(trim($hobby))) ?> text-blue-600 text-xl"></i>
                                        <span><?= htmlspecialchars(trim($hobby)) ?></span>
    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if(!empty($data['certificates'])):?>
                <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-certificate text-blue-600"></i>Chứng chỉ
                    </h2>
                    <div class="space-y-4">
                        <?php foreach($data['certificates'] as $item):?>
                        <div class="bg-white/50 rounded-xl p-4 border border-blue-100">
                            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($item['name'] ?? '') ?></h3>
                            <p class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm w-[100px]"><?= formatDateToVietnamese($item['date'] ?? '') ?></p>
                          
                        </div>   
                        <?php endforeach;?>                   
                    </div>
                </section>
                <?php endif;?>

                
                <?php if (!empty($data['awards'])): ?>
                    <section class="bg-white/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-trophy text-blue-600"></i>Giải thưởng
                        </h2>
                        <div class="space-y-4">
                            <?php foreach ($data['awards'] as $item): ?>
                                <div class="bg-white/50 rounded-xl p-4 border border-blue-100">
                                    <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($item['name'] ?? '') ?></h3>
                                    <p class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm w-[100px]">
                                        <?= formatDateToVietnamese($item['date'] ?? '') ?></p>
                                    <p class="text-gray-600 mt-2"><?= formatDescription($item['description'] ?? '') ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>

<?php
// Hàm phụ trợ để lấy icon cho sở thích (giả định)
function getHobbyIcon($hobby)
{
    $hobbyIcons = [
        'photography' => 'camera',
        'hiking' => 'hiking',
        'reading' => 'book',
        'music' => 'music',
        'painting' => 'palette',
        'cycling' => 'bicycle',
    ];
    return $hobbyIcons[strtolower(trim($hobby))] ?? 'heart'; // Mặc định dùng heart nếu không có icon
}
?>
