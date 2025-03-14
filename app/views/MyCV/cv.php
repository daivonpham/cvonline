<?php
$majors = [
    'CNTT' => [
        'name' => 'Công nghệ thông tin',
        'sub_categories' => [
            'mobile_dev' => [
                'name' => 'Lập trình Mobile',
                'specializations' => [
                    'android' => 'Android Development',
                    'ios' => 'iOS Development',
                    'cross_platform' => 'Cross-platform Development'
                ]
            ],
            'web_dev' => [
                'name' => 'Lập trình Website',
                'specializations' => [
                    'frontend' => 'Frontend Development',
                    'backend' => 'Backend Development',
                    'fullstack' => 'Fullstack Development'
                ]
            ],
            'ai_data' => [
                'name' => 'Khoa học dữ liệu & AI',
                'specializations' => [
                    'ml' => 'Machine Learning',
                    'dl' => 'Deep Learning',
                    'de' => 'Data Engineering'
                ]
            ],
            'security' => [
                'name' => 'An toàn thông tin',
                'specializations' => [
                    'sys_security' => 'Bảo mật hệ thống',
                    'web_security' => 'Bảo mật web',
                    'crypto' => 'Mã hóa & Giải mã dữ liệu'
                ]
            ]
        ]
    ],
    'KTQT' => [
        'name' => 'Kinh tế - Quản trị',
        'sub_categories' => [
            'business' => [
                'name' => 'Quản trị kinh doanh',
                'specializations' => [
                    'marketing' => 'Marketing',
                    'hr' => 'Quản trị nhân sự',
                    'scm' => 'Quản lý chuỗi cung ứng'
                ]
            ],
            'finance' => [
                'name' => 'Tài chính - Ngân hàng',
                'specializations' => [
                    'banking' => 'Ngân hàng thương mại',
                    'investment' => 'Đầu tư tài chính',
                    'analysis' => 'Phân tích tài chính'
                ]
            ]
        ]
    ],
    'GDDT' => [
        'name' => 'Giáo dục - Đào tạo',
        'sub_categories' => [
            'teaching' => [
                'name' => 'Giáo dục phổ thông',
                'specializations' => [
                    'math' => 'Giáo viên Toán học',
                    'literature' => 'Giáo viên Ngữ văn',
                    'english' => 'Giáo viên Tiếng Anh'
                ]
            ],
            'special_edu' => [
                'name' => 'Giáo dục đặc biệt',
                'specializations' => [
                    'disability' => 'Giáo dục trẻ khuyết tật',
                    'autism' => 'Giáo dục trẻ tự kỷ',
                    'psychology' => 'Tâm lý học đường'
                ]
            ]
        ]
    ],

    'KHTN' => [
        'name' => 'Khoa học tự nhiên',
        'sub_categories' => [
            'physics' => [
                'name' => 'Vật lý học',
                'specializations' => [
                    'quantum' => 'Vật lý lượng tử',
                    'nuclear' => 'Vật lý hạt nhân',
                    'astrophysics' => 'Vật lý thiên văn'
                ]
            ],
            'chemistry' => [
                'name' => 'Hóa học',
                'specializations' => [
                    'organic' => 'Hóa hữu cơ',
                    'inorganic' => 'Hóa vô cơ',
                    'analytical' => 'Hóa phân tích'
                ]
            ],
            'biology' => [
                'name' => 'Sinh học',
                'specializations' => [
                    'genetics' => 'Di truyền học',
                    'micro' => 'Vi sinh vật học',
                    'ecology' => 'Sinh thái học'
                ]
            ]
        ]
    ],

    'NNTP' => [
        'name' => 'Nông nghiệp - Thực phẩm',
        'sub_categories' => [
            'agriculture' => [
                'name' => 'Nông nghiệp',
                'specializations' => [
                    'crop' => 'Trồng trọt',
                    'livestock' => 'Chăn nuôi',
                    'aquaculture' => 'Thủy sản'
                ]
            ],
            'food_tech' => [
                'name' => 'Công nghệ thực phẩm',
                'specializations' => [
                    'processing' => 'Chế biến thực phẩm',
                    'quality' => 'Quản lý chất lượng',
                    'nutrition' => 'Dinh dưỡng học'
                ]
            ]
        ]
    ],

    'DLDV' => [
        'name' => 'Du lịch - Dịch vụ',
        'sub_categories' => [
            'tourism' => [
                'name' => 'Du lịch',
                'specializations' => [
                    'hotel' => 'Quản lý khách sạn',
                    'restaurant' => 'Quản lý nhà hàng',
                    'tour' => 'Điều hành tour'
                ]
            ],
            'hospitality' => [
                'name' => 'Dịch vụ',
                'specializations' => [
                    'event' => 'Tổ chức sự kiện',
                    'spa' => 'Spa & Làm đẹp',
                    'service' => 'Chăm sóc khách hàng'
                ]
            ]
        ]
    ],

    'MTNL' => [
        'name' => 'Môi trường - Năng lượng',
        'sub_categories' => [
            'environment' => [
                'name' => 'Môi trường',
                'specializations' => [
                    'protection' => 'Bảo vệ môi trường',
                    'waste' => 'Quản lý chất thải',
                    'impact' => 'Đánh giá tác động'
                ]
            ],
            'energy' => [
                'name' => 'Năng lượng',
                'specializations' => [
                    'solar' => 'Năng lượng mặt trời',
                    'wind' => 'Năng lượng gió',
                    'biomass' => 'Năng lượng sinh học'
                ]
            ]
        ]
    ],

    'TTTT' => [
        'name' => 'Thể thao',
        'sub_categories' => [
            'coaching' => [
                'name' => 'Huấn luyện',
                'specializations' => [
                    'football' => 'Bóng đá',
                    'swimming' => 'Bơi lội',
                    'athletics' => 'Điền kinh'
                ]
            ],
            'sports_science' => [
                'name' => 'Khoa học thể thao',
                'specializations' => [
                    'physio' => 'Vật lý trị liệu',
                    'nutrition' => 'Dinh dưỡng thể thao',
                    'psychology' => 'Tâm lý thể thao'
                ]
            ]
        ]
    ],

    'TCNH' => [
        'name' => 'Tài chính - Ngân hàng',
        'sub_categories' => [
            'finance' => [
                'name' => 'Tài chính',
                'specializations' => [
                    'corporate' => 'Tài chính doanh nghiệp',
                    'investment' => 'Đầu tư tài chính',
                    'risk' => 'Quản trị rủi ro'
                ]
            ],
            'banking' => [
                'name' => 'Ngân hàng',
                'specializations' => [
                    'retail' => 'Ngân hàng bán lẻ',
                    'investment_banking' => 'Ngân hàng đầu tư',
                    'fintech' => 'Công nghệ tài chính'
                ]
            ]
        ]
    ],

    'YDSK' => [
        'name' => 'Y dược - Sức khỏe',
        'sub_categories' => [
            'medicine' => [
                'name' => 'Y khoa',
                'specializations' => [
                    'general' => 'Bác sĩ đa khoa',
                    'surgery' => 'Phẫu thuật',
                    'pediatrics' => 'Nhi khoa'
                ]
            ],
            'pharmacy' => [
                'name' => 'Dược học',
                'specializations' => [
                    'clinical' => 'Dược lâm sàng',
                    'industrial' => 'Công nghiệp dược',
                    'pharmacology' => 'Dược lý học'
                ]
            ],
            'nursing' => [
                'name' => 'Điều dưỡng',
                'specializations' => [
                    'general_nursing' => 'Điều dưỡng đa khoa',
                    'emergency' => 'Cấp cứu',
                    'pediatric_nursing' => 'Điều dưỡng nhi'
                ]
            ]
        ]
    ],

    'KTCN' => [
        'name' => 'Kỹ thuật - Công nghệ',
        'sub_categories' => [
            'mechanical' => [
                'name' => 'Cơ khí',
                'specializations' => [
                    'automation' => 'Tự động hóa',
                    'manufacturing' => 'Chế tạo máy',
                    'maintenance' => 'Bảo trì công nghiệp'
                ]
            ],
            'electrical' => [
                'name' => 'Điện - Điện tử',
                'specializations' => [
                    'power' => 'Hệ thống điện',
                    'electronics' => 'Điện tử viễn thông',
                    'control' => 'Điều khiển tự động'
                ]
            ]
        ]
    ],

    'LPCS' => [
        'name' => 'Luật pháp - Chính sách',
        'sub_categories' => [
            'law' => [
                'name' => 'Luật',
                'specializations' => [
                    'civil' => 'Luật dân sự',
                    'criminal' => 'Luật hình sự',
                    'business_law' => 'Luật kinh doanh'
                ]
            ],
            'policy' => [
                'name' => 'Chính sách công',
                'specializations' => [
                    'public_policy' => 'Chính sách công',
                    'governance' => 'Quản lý nhà nước',
                    'international' => 'Quan hệ quốc tế'
                ]
            ]
        ]
    ],

    'XHNV' => [
        'name' => 'Xã hội - Nhân văn',
        'sub_categories' => [
            'sociology' => [
                'name' => 'Xã hội học',
                'specializations' => [
                    'research' => 'Nghiên cứu xã hội',
                    'development' => 'Phát triển cộng đồng',
                    'culture' => 'Văn hóa học'
                ]
            ],
            'linguistics' => [
                'name' => 'Ngôn ngữ học',
                'specializations' => [
                    'english' => 'Tiếng Anh',
                    'japanese' => 'Tiếng Nhật',
                    'korean' => 'Tiếng Hàn'
                ]
            ]
        ]
    ],

    'NTTK' => [
        'name' => 'Nghệ thuật - Thiết kế',
        'sub_categories' => [
            'design' => [
                'name' => 'Thiết kế',
                'specializations' => [
                    'graphic' => 'Thiết kế đồ họa',
                    'interior' => 'Thiết kế nội thất',
                    'fashion' => 'Thiết kế thời trang'
                ]
            ],
            'fine_arts' => [
                'name' => 'Mỹ thuật',
                'specializations' => [
                    'painting' => 'Hội họa',
                    'sculpture' => 'Điêu khắc',
                    'digital_art' => 'Nghệ thuật số'
                ]
            ]
        ]
    ],

    'TTBC' => [
        'name' => 'Truyền thông - Báo chí',
        'sub_categories' => [
            'media' => [
                'name' => 'Truyền thông',
                'specializations' => [
                    'digital_media' => 'Truyền thông số',
                    'pr' => 'Quan hệ công chúng',
                    'advertising' => 'Quảng cáo'
                ]
            ],
            'journalism' => [
                'name' => 'Báo chí',
                'specializations' => [
                    'news' => 'Báo chí truyền thống',
                    'broadcast' => 'Báo chí phát thanh - truyền hình',
                    'online' => 'Báo điện tử'
                ]
            ]
        ]
    ],

    'QPAN' => [
        'name' => 'Quốc phòng - An ninh',
        'sub_categories' => [
            'military' => [
                'name' => 'Quân sự',
                'specializations' => [
                    'tactics' => 'Chiến thuật',
                    'logistics' => 'Hậu cần quân sự',
                    'technology' => 'Kỹ thuật quân sự'
                ]
            ],
            'security' => [
                'name' => 'An ninh',
                'specializations' => [
                    'cybersecurity' => 'An ninh mạng',
                    'investigation' => 'Điều tra tội phạm',
                    'intelligence' => 'Tình báo'
                ]
            ]
        ]
    ],

    'TLXH' => [
        'name' => 'Tâm lý học - Khoa học xã hội',
        'sub_categories' => [
            'psychology' => [
                'name' => 'Tâm lý học',
                'specializations' => [
                    'clinical' => 'Tâm lý lâm sàng',
                    'educational' => 'Tâm lý giáo dục',
                    'counseling' => 'Tư vấn tâm lý'
                ]
            ],
            'social_science' => [
                'name' => 'Khoa học xã hội',
                'specializations' => [
                    'anthropology' => 'Nhân học',
                    'philosophy' => 'Triết học',
                    'history' => 'Lịch sử học'
                ]
            ]
        ]
    ],

    'KTXD' => [
        'name' => 'Kiến trúc - Xây dựng',
        'sub_categories' => [
            'architecture' => [
                'name' => 'Kiến trúc',
                'specializations' => [
                    'building' => 'Kiến trúc công trình',
                    'urban' => 'Quy hoạch đô thị',
                    'landscape' => 'Kiến trúc cảnh quan'
                ]
            ],
            'construction' => [
                'name' => 'Xây dựng',
                'specializations' => [
                    'civil' => 'Xây dựng dân dụng',
                    'industrial' => 'Xây dựng công nghiệp',
                    'infrastructure' => 'Hạ tầng kỹ thuật'
                ]
            ]
        ]
    ],

    'LGVT' => [
        'name' => 'Logistics - Vận tải',
        'sub_categories' => [
            'logistics' => [
                'name' => 'Logistics',
                'specializations' => [
                    'supply_chain' => 'Quản lý chuỗi cung ứng',
                    'warehouse' => 'Quản lý kho vận',
                    'procurement' => 'Thu mua & Cung ứng'
                ]
            ],
            'transportation' => [
                'name' => 'Vận tải',
                'specializations' => [
                    'maritime' => 'Vận tải biển',
                    'aviation' => 'Vận tải hàng không',
                    'land' => 'Vận tải đường bộ'
                ]
            ]
        ]
    ]
];

$languages = [
    'eng' => 'Tiếng Anh',
    'jpn' => 'Tiếng Nhật',
    'kor' => 'Tiếng Hàn',
    'chn' => 'Tiếng Trung',
    'fra' => 'Tiếng Pháp',
    'ger' => 'Tiếng Đức',
    'spa' => 'Tiếng Tây Ban Nha',
    'rus' => 'Tiếng Nga',
    'tha' => 'Tiếng Thái',
    'vie' => 'Tiếng Việt'
];
?>
<main>
    <form action="/createcv" method="POST">
        <div class="container">
            <div class="card-body card mb-3 mt-3">
                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Tên CV</label>
                    <span class="icon-required">*</span>
                    <div class="cv-url">
                        <input class="form-control" type="text" id="name" name="name" placeholder="CV Backend Developer"
                            autofocus="" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    <span class="text-danger"><?= !empty($errors['name']) ? reset($errors['name']) : ''; ?></span>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="cv-url" class="form-label">slug/ cv url</label>
                    <span class="icon-required">*</span>
                    <div class="cv-url">
                        <span class="cv-span">https://dtsnova.online/</span>
                        <input class="form-control cv-input" type="text" id="cv-url" name="cv-url"
                            placeholder="daivonpham" autofocus=""
                            value="<?= htmlspecialchars($_POST['cv-url'] ?? '') ?>">
                    </div>
                    <span class="text-danger"><?= !empty($errors['cv-url']) ? reset($errors['cv-url']) : ''; ?></span>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="target" class="form-label">Mục tiêu nghề nghiệp</label>
                    <div class="cv-url">
                        <textarea class="form-control" type="text" id="target" name="target" placeholder="Mục tiêu nghề nghiệp của bạn"
                            autofocus=""><?= htmlspecialchars($_POST['target'] ?? '') ?></textarea>
                    </div>
                    <span class="text-danger"><?= !empty($errors['target']) ? reset($errors['target']) : ''; ?></span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row container-p-y focus">
                <!-- Box left -->
                <div class="col-md-6">
                    <!-- Học vấn -->
                    <div class="card mb-4">
                        <h5 class="card-header">Học vấn</h5>
                        <div class="card-body pt-none" id="education-form">
                            <div class="mb-3">
                                <label for="edu-schoolname" class="form-label">Tên trường</label>
                                <input type="text" class="form-control" id="edu-schoolname" name="edu-schoolname[]"
                                    placeholder="Đại học abc"
                                    value="<?= htmlspecialchars($_POST['edu-schoolname'][0] ?? '') ?>">
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="edu-start-date" class="form-label">Thời gian bắt đầu</label>
                                    <input type="date" class="form-control" id="edu-start-date" name="edu-start-date[]"
                                        value="<?= htmlspecialchars($_POST['edu-start-date'][0] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="edu-end-date" class="form-label">Thời gian kết thúc</label>
                                    <input type="date" class="form-control" id="edu-end-date" name="edu-end-date[]"
                                        value="<?= htmlspecialchars($_POST['edu-end-date'][0] ?? '') ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edu-major" class="form-label">Chuyên ngành</label>
                                <div class="dropdown-container">
                                    <button type="button" class="dropdown-btn form-control" id="edu-major-btn">Chọn
                                        chuyên ngành</button>
                                    <input type="hidden" id="edu-major" name="edu-major[]"
                                        value="<?= htmlspecialchars($_POST['edu-major'][0] ?? '') ?>">
                                    <div class="nested-dropdown">
                                        <ul class="main-menu">
                                            <?php foreach ($majors as $majorKey => $major): ?>
                                                <li class="menu-item-major">
                                                    <span><?php echo $major['name']; ?></span>
                                                    <ul class="sub-menu">
                                                        <?php foreach ($major['sub_categories'] as $subKey => $subCategory): ?>
                                                            <li class="menu-item-major">
                                                                <span><?php echo $subCategory['name']; ?></span>
                                                                <ul class="sub-menu">
                                                                    <?php foreach ($subCategory['specializations'] as $specKey => $specName): ?>
                                                                        <li class="menu-item-final"
                                                                            data-value="<?php echo $specName; ?>">
                                                                            <?php echo $specName; ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edu-achievements" class="form-label">Thành tích</label>
                                <input type="text" class="form-control" id="edu-achievements" name="edu-achievements[]"
                                    placeholder="Tốt nghiệp loại giỏi, GPA: 3.8/4"
                                    value="<?= htmlspecialchars($_POST['edu-achievements'][0] ?? '') ?>">
                            </div>

                            <button type="button" class="btn btn-danger btn-sm float-right btn-education">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-education">Thêm học vấn</button>

                    <!-- Kỹ năng -->
                    <div class="card mb-4">
                        <h5 class="card-header">Kỹ năng</h5>
                        <div class="card-body pt-none" id="skill-form">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="skill-skillname" class="form-label">Tên kỹ năng</label>
                                    <input type="text" class="form-control" id="skill-skillname"
                                        name="skill-skillname[]" placeholder="Backend"
                                        value="<?= htmlspecialchars($_POST['skill-skillname'][0] ?? '') ?>">
                                </div>
                                <div class="col-md-9 mb-3">
                                    <label for="skill-decription_skill" class="form-label">Mô tả kỹ năng</label>
                                    <input type="text" class="form-control" id="skill-decription_skill"
                                        name="skill-decription_skill[]" placeholder="PHP, laravel, Nodejs..."
                                        value="<?= htmlspecialchars($_POST['skill-decription_skill'][0] ?? '') ?>">
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-skill">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-skill">Thêm kỹ năng</button>

                    <!-- Danh hiệu và giải thưởng -->
                    <div class="card mb-4">
                        <h5 class="card-header">Danh hiệu và giải thưởng</h5>
                        <div class="card-body pt-none" id="award-form">
                            <div class="mb-3">
                                <label for="award-date" class="form-label">Thời gian</label>
                                <input type="date" class="form-control" id="award-date" name="award-date[]"
                                    value="<?= htmlspecialchars($_POST['award-date'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="award-name" class="form-label">Tên Giải thưởng</label>
                                <input type="text" class="form-control" id="award-name" name="award-name[]"
                                    placeholder="Giải nhất cuộc thi abc"
                                    value="<?= htmlspecialchars($_POST['award-name'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="award-decription" class="form-label">Mô tả danh hiệu</label>
                                <textarea type="text" class="form-control" id="award-decription" name="award-decription[]"
                                    placeholder="Mô tả"
                                    value="<?= htmlspecialchars($_POST['award-decription'][0] ?? '') ?>"></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-award">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-award">Thêm Danh hiệu</button>

                    <!-- Hoạt động -->
                    <div class="card mb-4">
                        <h5 class="card-header">Hoạt động</h5>
                        <div class="card-body pt-none" id="activity-form">
                            <div class="mb-3">
                                <label for="acti-date" class="form-label">Thời gian bắt đầu</label>
                                <input type="date" class="form-control" id="acti-date" name="acti-date[]"
                                    value="<?= htmlspecialchars($_POST['acti-date'][0] ?? '') ?>">

                            </div>
                            <div class="mb-3">
                                <label for="acti-name" class="form-label">Tên Tổ chức</label>
                                <input type="text" class="form-control" id="acti-name" name="acti-name[]"
                                    placeholder="Tổ chức abc"
                                    value="<?= htmlspecialchars($_POST['acti-name'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="acti-decription" class="form-label">Mô tả hoạt động</label>
                                <textarea class="form-control" id="acti-decription" name="acti-decription[]"
                                    placeholder="Mô tả hoạt động..."><?= htmlspecialchars($_POST['acti-decription'][0] ?? '') ?></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-activity">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-activity">Thêm Hoạt Động</button>

                    <!-- Sở thích -->
                    <div class="card mb-4">
                        <h5 class="card-header">Sở thích</h5>
                        <div class="card-body pt-none" id="hobies-form">
                            <div class="mb-3">
                                <label for="hobies-name" class="form-label">Sở thích</label>
                                <textarea class="form-control" id="hobies-name" name="hobies-name"
                                    placeholder="Điền sở thích của bạn"><?= htmlspecialchars($_POST['hobies-name'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box right -->
                <div class="col-md-6">
                    <!-- Kinh nghiệm làm việc -->
                    <div class="card mb-4">
                        <h5 class="card-header">Kinh nghiệm làm việc</h5>
                        <div class="card-body pt-none" id="experientce-work-form">
                            <div class="mb-3">
                                <label for="company-name" class="form-label">Tên Công Ty</label>
                                <input type="text" class="form-control" id="company-name" name="company-name[]"
                                    placeholder="Công Ty TNHH abc"
                                    value="<?= htmlspecialchars($_POST['company-name'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="company-start-date" class="form-label">Thời gian bắt đầu</label>
                                    <input type="date" class="form-control" id="company-start-date"
                                        name="company-start-date[]"
                                        value="<?= htmlspecialchars($_POST['company-start-date'][0] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="company-end-date" class="form-label">Thời gian kết thúc</label>
                                    <input type="date" class="form-control" id="company-end-date"
                                        name="company-end-date[]"
                                        value="<?= htmlspecialchars($_POST['company-end-date'][0] ?? '') ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="company-position" class="form-label">Vị trí</label>
                                <input type="text" class="form-control" id="company-position" name="company-position[]"
                                    placeholder="Backend Developer"
                                    value="<?= htmlspecialchars($_POST['company-position'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="company-decription-work" class="form-label">Mô tả công việc</label>
                                <textarea class="form-control" name="company-decription-work[]"
                                    placeholder="Mô tả công việc..."
                                    id="company-decription-work"><?= htmlspecialchars($_POST['company-decription-work'][0] ?? '') ?></textarea>

                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-experientce">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-experientce-work">Thêm kinh
                        nghiệm làm việc</button>

                    <!-- Dự án -->
                    <div class="card mb-4">
                        <h5 class="card-header">Dự án</h5>
                        <div class="card-body pt-none" id="project-form">
                            <div class="mb-3">
                                <label for="project-name" class="form-label">Tên Dự Án</label>
                                <input type="text" class="form-control" id="project-name" name="project-name[]"
                                    placeholder="Dự án thư viện điện tử"
                                    value="<?= htmlspecialchars($_POST['project-name'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="project-start-date" class="form-label">Thời gian bắt đầu</label>
                                    <input type="date" class="form-control" id="project-start-date"
                                        name="project-start-date[]"
                                        value="<?= htmlspecialchars($_POST['project-start-date'][0] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="project-end-date" class="form-label">Thời gian kết thúc</label>
                                    <input type="date" class="form-control" id="project-end-date"
                                        name="project-end-date[]"
                                        value="<?= htmlspecialchars($_POST['project-end-date'][0] ?? '') ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="project-position" class="form-label">Vị trí</label>
                                <input type="text" class="form-control" id="project-position" name="project-position[]"
                                    placeholder="Backend Developer"
                                    value="<?= htmlspecialchars($_POST['project-position'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="project-quantity-people" class="form-label">Số lượng người tham
                                    gia</label>
                                <input type="text" class="form-control" name="project-quantity-people[]"
                                    placeholder="Số lượng thành viên: 6 người" id="project-quantity-people"
                                    value="<?= htmlspecialchars($_POST['project-quantity-people'][0] ?? '') ?>">

                            </div>
                            <div class="mb-3">
                                <label for="project-role" class="form-label">Vai trò và trách nhiệm</label>
                                <textarea type="text" class="form-control" name="project-role[]" placeholder="Vai trò..."
                                    id="project-role" value="<?= htmlspecialchars($_POST['project-role'][0] ?? '') ?>"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="project-tech" class="form-label">Công nghệ sử dụng</label>
                                <input type="text" class="form-control" name="project-tech[]"
                                    placeholder="Tích hợp Socket.IO cho real-time." id="project-tech"
                                    value="<?= htmlspecialchars($_POST['project-tech'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="project-decription" class="form-label">Mô tả dự án</label>
                                <textarea class="form-control" name="project-decription[]" placeholder="Mô tả dự án..."
                                    id="project-decription"><?= htmlspecialchars($_POST['project-decription'][0] ?? '') ?></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-project">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-project">Thêm dự án</button>

                    <!-- Chứng chỉ -->
                    <div class="card mb-4">
                        <h5 class="card-header">Chứng chỉ</h5>
                        <div class="card-body pt-none" id="certificate-form">
                            <div class="mb-3">
                                <label for="certi-date" class="form-label">Thời gian</label>
                                <input type="date" class="form-control" id="certi-date" name="certi-date[]"
                                    value="<?= htmlspecialchars($_POST['certi-date'][0] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="certi-name" class="form-label">Tên chứng chỉ</label>
                                <input type="text" class="form-control" id="certi-name" name="certi-name[]"
                                    placeholder="Giải nhất cuộc thi abc"
                                    value="<?= htmlspecialchars($_POST['certi-name'][0] ?? '') ?>">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm float-right btn-certificate">Xóa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-add-form" id="add-certificate">Thêm Chứng
                        Chỉ</button>

                    <!-- Ngôn ngữ -->
                    <div class="card mb-4">
                        <h5 class="card-header">Ngôn ngữ</h5>
                        <div class="card-body pt-none" id="language-form">
                            <div class="mb-3">
                                <label class="form-label">Chọn ngôn ngữ</label>
                                <div id="selected-languages"></div>
                                <div class="dropdown-container">
                                    <button type="button" class="dropdown-btn form-control" id="language-btn">Chọn
                                        ngôn
                                        ngữ</button>
                                    <input type="hidden" id="language" name="language[]"
                                        value="<?= htmlspecialchars($_POST['language'][0] ?? '') ?>">
                                    <div class="nested-dropdown-lang">
                                        <ul class="main-menu">
                                            <?php foreach ($languages as $code => $name): ?>
                                                <li class="menu-item-final-lang" data-value="<?php echo $name; ?>">
                                                    <?php echo $name; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info float-right color-white">Lưu CV</button>
        </div>
    </form>
</main>