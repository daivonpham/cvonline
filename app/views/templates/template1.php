<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporate Professional Resume - <?= htmlspecialchars($data['cv']['name'] ?? 'CV') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-background min-h-screen p-4 md:p-8">
    <div class="max-w-5xl mx-auto bg-card shadow-lg rounded-lg overflow-hidden">
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Left Sidebar -->
            <div class="bg-secondary p-6 space-y-6">
                <!-- Profile Image & Name -->
                <div class="text-center">
                    <img src="<?= isset($data['cv']['avatar']) ? '/images/avatar/' . htmlspecialchars($data['cv']['avatar']) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9' ?>"
                        alt="Profile Photo" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h1 class="text-xl font-heading text-foreground"><?= htmlspecialchars($data['cv']['fullname'] ?? '') ?></h1>
                    <p class="text-accent"><?= htmlspecialchars($data['cv']['major'] ?? '') ?></p>
                </div>

                <!-- Contact Information -->
                <?php if (!empty($data['cv']['email']) || !empty($data['cv']['phone']) || !empty($data['cv']['address'])): ?>
                <div class="space-y-4">
                    <h2 class="text-lg font-heading text-foreground border-b border-border pb-2">
                        <i class="fas fa-address-card mr-2"></i>Liên hệ
                    </h2>
                    <div class="space-y-2 text-sm">
                        <?php if (!empty($data['cv']['email'])): ?>
                            <p class="flex items-center text-accent">
                                <i class="fas fa-envelope w-8"></i><?= htmlspecialchars($data['cv']['email']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($data['cv']['phone'])): ?>
                            <p class="flex items-center text-accent">
                                <i class="fas fa-phone w-8"></i><?= htmlspecialchars($data['cv']['phone']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($data['cv']['address'])): ?>
                            <p class="flex items-center text-accent">
                                <i class="fas fa-map-marker-alt w-8"></i><?= htmlspecialchars($data['cv']['address']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($data['cv']['website'])): ?>
                            <p class="flex items-center text-accen"><i
                                    class="fas fa-globe text-blue-600"></i><?= htmlspecialchars($data['cv']['website']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Social Networks -->
                <?php if (!empty($data['social_link'])): ?>
                <div class="space-y-4">
                    <h2 class="text-lg font-heading text-foreground border-b border-border pb-2">
                        <i class="fas fa-globe mr-2"></i>Mạng xã hội
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
                               class="text-accent hover:text-primary transition-colors">
                                <i class="<?= htmlspecialchars($icon) ?> text-xl"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Skills -->
                <?php if (!empty($data['skills'])): ?>
                <div class="space-y-4">
                    <h2 class="text-lg font-heading text-foreground border-b border-border pb-2">
                        <i class="fas fa-code mr-2"></i>Kỹ năng
                    </h2>
                    <div class="space-y-4">
                        <?php
                        $groupedSkills = [];
                        foreach ($data['skills'] as $skill) {
                            $nameSkill = $skill['name_skill'] ?? 'Other';
                            if (!isset($groupedSkills[$nameSkill])) {
                                $groupedSkills[$nameSkill] = [];
                            }
                            $groupedSkills[$nameSkill][] = $skill['skills'];
                        }
                        
                        foreach ($groupedSkills as $category => $skills): ?>
                            <div class="mb-3">
                                <h3 class="text-sm font-semibold text-foreground mb-2"><?= htmlspecialchars($category) ?>:</h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($skills as $skill): ?>
                                        <span class="px-2 py-1 bg-primary text-black rounded-full text-sm">
                                            <?= htmlspecialchars($skill) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Languages -->
                <?php if (!empty($data['language'])): ?>
                <div class="space-y-4">
                    <h2 class="text-lg font-heading text-foreground border-b border-border pb-2">
                        <i class="fas fa-language mr-2"></i>Ngôn ngữ
                    </h2>
                    <div class="space-y-2">
                        <?php foreach ($data['language'] as $lang): ?>
                            <p class="text-accent"><?= nl2br(formatData($lang['name'] ?? '')) ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Certifications -->
                <?php if (!empty($data['certificates'])): ?>
                    <div class="space-y-4">
                        <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                            <i class="fas fa-certificate mr-2"></i>Certifications
                        </h2>
                        <div class="space-y-2">
                            <?php foreach ($data['certificates'] as $cert): ?>
                                <div class="text-base bg-secondary rounded-lg flex gap-3">
                                    <h3 class="text-base font-heading text-foreground">&#10148
                                        <?= htmlspecialchars($cert['name'] ?? '') ?>
                                    </h3>
                                    <p class="text-accent">
                                        <?= formatDateToVietnamese($cert['date'] ?? '') ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Awards -->
                <?php if (!empty($data['awards'])): ?>
                    <div class="space-y-4">
                        <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                            <i class="fas fa-trophy mr-2"></i>Awards
                        </h2>
                        <div class="space-y-3">
                            <?php foreach ($data['awards'] as $award): ?>
                                <div class=" bg-secondary rounded-lg text-base">
                                <div class="flex gap-3">
                                    <h3 class=" font-heading text-foreground">
                                        <?= htmlspecialchars($award['name'] ?? '') ?>
                                    </h3>
                                    <p class="text-accent">
                                        <?= formatDateToVietnamese($award['date'] ?? '') ?>
                                    </p>
                                    </div>
                                    <?php if (!empty($award['description'])): ?>
                                        <p class="text-accent mt-2">
                                            <?= formatDescriptionTem1($award['description']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                                    </div>
                <?php endif; ?>

                <!-- Hobbies -->
                <?php
                $hobbies = explode(',', $data['cv']['hobbies'] ?? '');
                $hasHobbies = false;
                foreach ($hobbies as $hobby) {
                    if (trim($hobby) !== '') {
                        $hasHobbies = true;
                        break;
                    }
                }
                if ($hasHobbies):
                ?>
                <div class="space-y-4">
                    <h2 class="text-lg font-heading text-foreground border-b border-border pb-2">
                        <i class="fas fa-heart mr-2"></i>Hobbies
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($hobbies as $hobby):
                            if (trim($hobby) !== ''): ?>
                                <span class="px-3 py-1 bg-primary text-white rounded-full text-sm">
                                    <?= htmlspecialchars(trim($hobby)) ?>
                                </span>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 p-6 space-y-6">
                <!-- Professional Summary -->
                <?php if (!empty($data['cv']['target'])): ?>
                <section class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                        <i class="fas fa-bullseye mr-2"></i>Mục tiêu nghề nghiệp
                    </h2>
                    <p class="text-accent"><?= nl2br(htmlspecialchars($data['cv']['target'])) ?></p>
                </section>
                <?php endif; ?>

                <!-- Work Experience -->
                <?php if (!empty($data['work_experience'])): ?>
                <section class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                        <i class="fas fa-briefcase mr-2"></i>Kinh nghiệm làm việc
                    </h2>
                    <div class="space-y-4">
                        <?php foreach ($data['work_experience'] as $work): ?>
                            <div>
                                <h3 class="text-lg font-heading text-foreground">
                                    <?= htmlspecialchars($work['position'] ?? '') ?>
                                </h3>
                                <p class=" font-body">
                                    <?= htmlspecialchars($work['company'] ?? '') ?> | 
                                    <?= formatDateToVietnamese($work['start_date'] ?? '') ?> - 
                                    <?= formatDateToVietnamese($work['end_date'] ?? 'Present') ?>
                                </p>
                                <?= formatDescriptionTem1($work['description'] ?? '') ?>
                            
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Education -->
            <?php if (!empty($data['education'])): ?>
                <section class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                        <i class="fas fa-graduation-cap mr-2"></i>Học vấn
                    </h2>
                    <?php foreach ($data['education'] as $edu): ?>
                        <div>
                            <h3 class="text-lg font-heading text-foreground">
                                <?= htmlspecialchars($edu['major'] ?? '') ?>
                            </h3>
                            <p class=" font-body">
                                <?= htmlspecialchars($edu['school'] ?? '') ?> |
                                <?= formatDateToVietnamese($edu['start_date'] ?? '') ?> -
                                <?= formatDateToVietnamese($edu['end_date'] ?? '') ?>
                            </p>
                            <p class="text-accent mt-2">
                                <?= htmlspecialchars($edu['achievements'] ?? '') ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>

                <!-- Projects -->
                <?php if (!empty($data['projects'])): ?>
                <section class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                        <i class="fas fa-project-diagram mr-2"></i>Dự án
                    </h2>
                    <div class="space-y-4">
                        <?php foreach ($data['projects'] as $project): ?>
                            <div class="rounded-lg">
                                <h3 class="text-lg font-heading text-foreground">
                                    <?= htmlspecialchars($project['name'] ?? '') ?>
                                </h3>
                                <p class=" font-body">
                                    <?= htmlspecialchars($project['position'] ?? '') ?> | 
                                    <?= formatDateToVietnamese($project['start_date'] ?? '') ?> - 
                                    <?= formatDateToVietnamese($project['end_date'] ?? 'Present') ?>
                                </p>
                                <?php if (!empty($project['team_num'])): ?>
                                    <div class="flex items-center gap-2 mt-2">
                                        <i class="fas fa-users"></i>
                                        <span class="text-accent">Team size: <?= htmlspecialchars($project['team_num']) ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($project['tech'])): ?>
                                    <div class="mt-2">
                                        <h4 class="text-sm font-semibold text-foreground">Công nghệ sử dụng:</h4>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            <?= formatLangtech($project['tech']) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($project['role'])): ?>
                                    <div class="mt-2">
                                        <h4 class="text-sm font-semibold text-foreground">Vai trò & trách nhiệm:</h4>
                                        <?= formatDescriptionTem1($project['role']) ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($project['description'])): ?>
                                    <div class="">
                                        <h4 class="text-sm font-semibold text-foreground">Project Description:</h4>
                                        <p class="text-accent"><?= formatDescriptionTem1($project['description']) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                

                <!-- Activities -->
                <?php if (!empty($data['activities'])): ?>
                <section class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-xl font-heading text-foreground border-b border-border pb-2 mb-4">
                        <i class="fas fa-running mr-2"></i>Hoạt động
                    </h2>
                    <div class="space-y-4">
                        <?php foreach ($data['activities'] as $activity): ?>
                            <div>
                                <h3 class="text-lg font-heading text-foreground">
                                    <?= htmlspecialchars($activity['name'] ?? '') ?>
                                </h3>
                                <p class=" font-body">
                                    <?= formatDateToVietnamese($activity['date'] ?? '') ?>
                                </p>
                                <?php if (!empty($activity['description'])): ?>
                                    <p class="text-accent mt-2">
                                        <?= formatDescriptionTem1($activity['description']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <style>
        .bg-background { background-color: #f0f2f5; }
        .bg-card { background-color: white; }
        .bg-secondary { background-color: #f8fafc; }
        .text-foreground { color: #1a202c; }
        .text-accent { color: #4a5568; }
        .text-primary { color: #3b82f6; }
        .border-border { border-color: #e2e8f0; }
        .font-heading { font-family: system-ui, -apple-system, sans-serif; }
        .font-body { font-family: system-ui, -apple-system, sans-serif; }
    </style>
</body>
</html>