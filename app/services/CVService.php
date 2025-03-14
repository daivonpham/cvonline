<?php

namespace App\Services;

use App\Models\CVModel;
use Rakit\Validation\Validator;
use App\Services\JwtService;

class CVService
{
    private $cvModel;
    private $jwtService;

    public function __construct()
    {
        $this->cvModel = new CVModel();
        $this->jwtService = new JwtService();
    }

    public function createCV($data)
    {
        $validator = new Validator();
        $userId = $this->jwtService->getUserId();
        $validation = $validator->make($data, [
            'name' => 'required|min:3',
            'cv-url' => 'required|min:3',
            'target' => '',
            // Education
            'edu-schoolname' => 'array',
            'edu-schoolname.*' => '',
            'edu-major' => 'array',
            'edu-major.*' => '',
            'edu-achievements' => 'array',
            'edu-achievements.*' => '',
            'edu-start-date' => 'array',
            'edu-start-date.*' => 'date',
            'edu-end-date' => 'array',
            'edu-end-date.*' => 'date',
            // Skills
            'skill-skillname' => 'array',
            'skill-skillname.*' => '',
            'skill-decription_skill' => 'array',
            'skill-decription_skill.*' => '',
            // Work Experience
            'company-name' => 'array',
            'company-name.*' => '',
            'company-position' => 'array',
            'company-position.*' => '',
            'company-decription-work' => 'array',
            'company-decription-work.*' => '',
            'company-start-date' => 'array',
            'company-start-date.*' => 'date',
            'company-end-date' => 'array',
            'company-end-date.*' => 'date',
            // Language
            'language' => 'array',
            'language.*' => '',
            // Certificates
            'certi-name' => 'array',
            'certi-name.*' => '',
            'certi-date' => 'array',
            'certi-date.*' => 'date',
            // Awards
            'award-name' => 'array',
            'award-name.*' => '',
            'award-date' => 'array',
            'award-date.*' => 'date',
            'award-decription' => 'array',
            'award-decription.*' => '',
            // Activities
            'acti-name' => 'array',
            'acti-name.*' => '',
            'acti-date' => 'array',
            'acti-date.*' => 'date',
            'acti-decription' => 'array',
            'acti-decription.*' => '',
            // Project
            'project-name' => 'array',
            'project-name.*' => '',
            'project-decription' => 'array',
            'project-decription.*' => '',
            'project-position' => 'array',
            'project-position.*' => '',
            'project-quantity-people' => 'array',
            'project-quantity-people.*' => 'numeric',
            'project-role' => 'array',
            'project-role.*' => '',
            'project-tech' => 'array',
            'project-tech.*' => '',
            'project-start-date' => 'array',
            'project-start-date.*' => 'date',
            'project-end-date' => 'array',
            'project-end-date.*' => 'date',
        ]);

        $validation->setMessages([
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'date' => ':attribute phải là ngày hợp lệ',
            'array' => ':attribute phải là một mảng',
            'numeric' => ':attribute phải là số',
            'after' => ':attribute phải sau ngày bắt đầu',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }

        // Tạo CV
        $cv_id = $this->cvModel->createCV($data['name'], $data['cv-url'], $userId, $data['target'] ?? null);
        if (!$cv_id) {
            return ['success' => false, 'errors' => ['database' => 'Không thể tạo CV']];
        }
        // Thêm Education
        if (!empty($data['edu-schoolname'])) {
            foreach ($data['edu-schoolname'] as $index => $school) {
                $major = $data['edu-major'][$index] ?: null;
                $achievements = $data['edu-achievements'][$index] ?: null;
                $start_date = $data['edu-start-date'][$index] ?: null;
                $end_date = $data['edu-end-date'][$index] ?: null;
                if (!empty($school) || !empty($major) || !empty($achievements) || !empty($start_date) || !empty($end_date)) {
                    $this->cvModel->addEducation($school, $major, $achievements, $start_date, $end_date, $cv_id);
                }
            }
        }

        // Thêm Skills
        if (!empty($data['skill-skillname'])) {
            foreach ($data['skill-skillname'] as $index => $name_skill) {
                $skills = $data['skill-decription_skill'][$index] ?: null;
                if (!empty($name_skill) || !empty($skills)) {
                    $this->cvModel->addSkills($name_skill, $skills, $cv_id);
                }
            }
        }

        // Thêm Work Experience
        if (!empty($data['company-name'])) {
            foreach ($data['company-name'] as $index => $company) {
                $position = $data['company-position'][$index] ?: null;
                $description = $data['company-decription-work'][$index] ?: null;
                $start_date = $data['company-start-date'][$index] ?: null;
                $end_date = $data['company-end-date'][$index] ?: null;
                if (!empty($company) || !empty($position) || !empty($description) || !empty($start_date) || !empty($end_date)) {
                    $this->cvModel->addWorkExperience($company, $position, $description, $start_date, $end_date, $cv_id);
                }
            }
        }

        // Thêm Language
        var_dump($data['language']);
        if (!empty($data['language'])) {
            foreach ($data['language'] as $index => $name) {
                if (!empty($name)) {
                    $this->cvModel->addLanguage($name, $cv_id);
                }
            }
        }

        // Thêm Certificates
        if (!empty($data['certi-name'])) {
            foreach ($data['certi-name'] as $index => $name) {
                $date = $data['certi-date'][$index] ?: null;
                if (!empty($name) || !empty($date)) {
                    $this->cvModel->addCertificate($name, $date, $cv_id);
                }
            }
        }

        // Thêm Awards
        if (!empty($data['award-name'])) {
            foreach ($data['award-name'] as $index => $name) {
                $date = $data['award-date'][$index] ?: null;
                $description = $data['award-decription'][$index] ?: null;
                if (!empty($name) || !empty($date) || !empty($description)) {
                    $this->cvModel->addAward($name, $date, $description, $cv_id);
                }
            }
        }

        // Thêm Activities
        if (!empty($data['acti-name'])) {
            foreach ($data['acti-name'] as $index => $name) {
                $date = $data['acti-date'][$index] ?: null;
                $description = $data['acti-decription'][$index] ?: null;
                if (!empty($name) || !empty($date) || !empty($description)) {
                    $this->cvModel->addActivity($name, $date, $description, $cv_id);
                }
            }
        }

        // Thêm Project
        if (!empty($data['project-name'])) {
            foreach ($data['project-name'] as $index => $name) {
                $description = $data['project-decription'][$index] ?: null;
                $position = $data['project-position'][$index] ?: null;
                $team_num = $data['project-quantity-people'][$index] ?: null;
                $role = $data['project-role'][$index] ?: null;
                $tech = $data['project-tech'][$index] ?: null;
                $start_date = $data['project-start-date'][$index] ?: null;
                $end_date = $data['project-end-date'][$index] ?: null;
                if (!empty($name) || !empty($description) || !empty($position) || !empty($team_num) || !empty($role) || !empty($tech) || !empty($start_date) || !empty($end_date)) {
                    $this->cvModel->addProject($name, $description, $position, $team_num, $role, $tech, $start_date, $end_date, $cv_id);
                }
            }
        }

        return ['success' => true, 'message' => 'CV đã được lưu thành công!', 'cv_id' => $cv_id];
    }


    public function updateTemplateCV($cvId, $templateId)
    {
        $validator = new Validator();
        $userId = $this->jwtService->getUserId();
        $data = [
            'cv_id' => $cvId,
            'template_id' => $templateId,
        ];
        $validation = $validator->make($data, [
            'cv_id' => 'required',
            'template_id' => 'required',
        ]);

        $validation->setMessages([
            'required' => 'Vui lòng chọn cv!',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }
        if ($this->cvModel->updateTemplateCV($cvId, $templateId)) {
            return ["success" => true, "message" => "Giao diện CV đã được cập nhật"];
        } else {
            return ["success" => false, "errors" => ["database" => "Không thể cập nhật giao diện CV"]];
        }
    }

    public function getCVForEdit($cvId)
    {

        $cv = $this->cvModel->getCVShowById($cvId);

        $cvData = [
            'cv' => $cv,
            'skills' => $this->cvModel->getSkillsByCVId($cvId),
            'education' => $this->cvModel->getEducationByCVId($cvId),
            'work_experience' => $this->cvModel->getWorkExperienceByCVId($cvId),
            'language' => $this->cvModel->getLanguageByCVId($cvId),
            'certificates' => $this->cvModel->getCertificatesByCVId($cvId),
            'awards' => $this->cvModel->getAwardsByCVId($cvId),
            'activities' => $this->cvModel->getActivitiesByCVId($cvId),
            'projects' => $this->cvModel->getProjectsByCVId($cvId),
        ];

        return $cvData;
    }
    public function getCVByLink($cvLink)
    {
        $cv = $this->cvModel->getCVByLink($cvLink);
        $cvData = [
            'cv' => $cv,
            'skills' => $this->cvModel->getSkillsByCVId($cv['cv_id']),
            'education' => $this->cvModel->getEducationByCVId($cv['cv_id']),
            'work_experience' => $this->cvModel->getWorkExperienceByCVId($cv['cv_id']),
            'language' => $this->cvModel->getLanguageByCVId($cv['cv_id']),
            'certificates' => $this->cvModel->getCertificatesByCVId($cv['cv_id']),
            'awards' => $this->cvModel->getAwardsByCVId($cv['cv_id']),
            'activities' => $this->cvModel->getActivitiesByCVId($cv['cv_id']),
            'projects' => $this->cvModel->getProjectsByCVId($cv['cv_id']),
            'social_link' => $this->cvModel->getLink($cv['user_id']),
        ];
        // check($cvData);
        return $cvData;
    }

    public function updateCV($cvId, $data)
    {
        $validator = new Validator();

        // Validation rules tương tự createCV
        $validation = $validator->make($data, [
            'name' => 'required|min:3',
            'cv_url' => 'required|min:3',
            'target' => '',
            // Education
            'edu-schoolname' => 'array',
            'edu-schoolname.*' => '',
            'edu-major' => 'array',
            'edu-major.*' => '',
            'edu-achievements' => 'array',
            'edu-achievements.*' => '',
            'edu-start-date' => 'array',
            'edu-start-date.*' => 'date',
            'edu-end-date' => 'array',
            'edu-end-date.*' => 'date',
            // Skills
            'skill-skillname' => 'array',
            'skill-skillname.*' => '',
            'skill-decription_skill' => 'array',
            'skill-decription_skill.*' => '',
            // Work Experience
            'company-name' => 'array',
            'company-name.*' => '',
            'company-position' => 'array',
            'company-position.*' => '',
            'company-decription-work' => 'array',
            'company-decription-work.*' => '',
            'company-start-date' => 'array',
            'company-start-date.*' => 'date',
            'company-end-date' => 'array',
            'company-end-date.*' => 'date',
            // Language
            'language' => 'array',
            'language.*' => '',
            // Certificates
            'certi-name' => 'array',
            'certi-name.*' => '',
            'certi-date' => 'array',
            'certi-date.*' => 'date',
            // Awards
            'award-name' => 'array',
            'award-name.*' => '',
            'award-date' => 'array',
            'award-date.*' => 'date',
            'award-decription' => 'array',
            'award-decription.*' => '',
            // Activities
            'acti-name' => 'array',
            'acti-name.*' => '',
            'acti-date' => 'array',
            'acti-date.*' => 'date',
            'acti-decription' => 'array',
            'acti-decription.*' => '',
            // Project
            'project-name' => 'array',
            'project-name.*' => '',
            'project-decription' => 'array',
            'project-decription.*' => '',
            'project-position' => 'array',
            'project-position.*' => '',
            'project-quantity-people' => 'array',
            'project-quantity-people.*' => 'numeric',
            'project-role' => 'array',
            'project-role.*' => '',
            'project-tech' => 'array',
            'project-tech.*' => '',
            'project-start-date' => 'array',
            'project-start-date.*' => 'date',
            'project-end-date' => 'array',
            'project-end-date.*' => 'date',
        ]);

        $validation->setMessages([
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'date' => ':attribute phải là ngày hợp lệ',
            'array' => ':attribute phải là một mảng',
            'numeric' => ':attribute phải là số',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray()];
        }

        // Cập nhật thông tin chính của CV
        $this->cvModel->updateCV($cvId, ['name' => $data['name'], 'cv_link' => $data['cv_url'], 'target' => $data['target'] ?? null]);

        // Cập nhật Education
        if (!empty($data['edu-schoolname'])) {
            $educationData = [];
            foreach ($data['edu-schoolname'] as $index => $school) {
                $major = $data['edu-major'][$index] ?: null;
                $achievements = $data['edu-achievements'][$index] ?: null;
                $start_date = $data['edu-start-date'][$index] ?: null;
                $end_date = $data['edu-end-date'][$index] ?: null;
                if (!empty($school) || !empty($major) || !empty($achievements) || !empty($start_date) || !empty($end_date)) {
                    $educationData[] = [
                        'school' => $school,
                        'major' => $major,
                        'achievements' => $achievements,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ];
                }
            }
            $this->cvModel->updateEducation($cvId, $educationData);
        }

        // Cập nhật Skills
        if (!empty($data['skill-skillname'])) {
            $skillsData = [];
            foreach ($data['skill-skillname'] as $index => $name_skill) {
                $skills = $data['skill-decription_skill'][$index] ?: null;
                if (!empty($name_skill) || !empty($skills)) {
                    $skillsData[] = [
                        'name_skill' => $name_skill,
                        'skills' => $skills,
                    ];
                }
            }
            $this->cvModel->updateSkills($cvId, $skillsData);
        }

        // Cập nhật Work Experience
        if (!empty($data['company-name'])) {
            $workExperienceData = [];
            foreach ($data['company-name'] as $index => $company) {
                $position = $data['company-position'][$index] ?: null;
                $description = $data['company-decription-work'][$index] ?: null;
                $start_date = $data['company-start-date'][$index] ?: null;
                $end_date = $data['company-end-date'][$index] ?: null;
                if (!empty($company) || !empty($position) || !empty($description) || !empty($start_date) || !empty($end_date)) {
                    $workExperienceData[] = [
                        'company' => $company,
                        'position' => $position,
                        'description' => $description,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ];
                }
            }
            $this->cvModel->updateWorkExperience($cvId, $workExperienceData);
        }

        // Cập nhật Language
        if (!empty($data['language'])) {
            $languageData = [];
            foreach ($data['language'] as $index => $name) {
                if (!empty($name)) {
                    $languageData[] = [
                        'name' => $name,
                    ];
                }
            }
            $this->cvModel->updateLanguage($cvId, $languageData);
        }

        // Cập nhật Certificates
        if (!empty($data['certi-name'])) {
            $certificatesData = [];
            foreach ($data['certi-name'] as $index => $name) {
                $date = $data['certi-date'][$index] ?: null;
                if (!empty($name) || !empty($date)) {
                    $certificatesData[] = [
                        'name' => $name,
                        'date' => $date,
                    ];
                }
            }
            $this->cvModel->updateCertificates($cvId, $certificatesData);
        }

        // Cập nhật Awards
        if (!empty($data['award-name'])) {
            $awardsData = [];
            foreach ($data['award-name'] as $index => $name) {
                $date = $data['award-date'][$index] ?: null;
                $description = $data['award-decription'][$index] ?: null;
                if (!empty($name) || !empty($date) || !empty($description)) {
                    $awardsData[] = [
                        'name' => $name,
                        'date' => $date,
                        'description' => $description,
                    ];
                }
            }
            $this->cvModel->updateAwards($cvId, $awardsData);
        }

        // Cập nhật Activities
        if (!empty($data['acti-name'])) {
            $activitiesData = [];
            foreach ($data['acti-name'] as $index => $name) {
                $date = $data['acti-date'][$index] ?: null;
                $description = $data['acti-decription'][$index] ?: null;
                if (!empty($name) || !empty($date) || !empty($description)) {
                    $activitiesData[] = [
                        'name' => $name,
                        'date' => $date,
                        'description' => $description,
                    ];
                }
            }
            $this->cvModel->updateActivities($cvId, $activitiesData);
        }
      

        // Cập nhật Projects
        if (!empty($data['project-name'])) {
            $projectsData = [];
            foreach ($data['project-name'] as $index => $name) {
                $description = $data['project-decription'][$index] ?: null;
                $position = $data['project-position'][$index] ?: null;
                $team_num = $data['project-quantity-people'][$index] ?: null;
                $role = $data['project-role'][$index] ?: null;
                $tech = $data['project-tech'][$index] ?: null;
                $start_date = $data['project-start-date'][$index] ?: null;
                $end_date = $data['project-end-date'][$index] ?: null;
                if (!empty($name) || !empty($description) || !empty($position) || !empty($team_num) || !empty($role) || !empty($tech) || !empty($start_date) || !empty($end_date)) {
                    $projectsData[] = [
                        'name' => $name,
                        'description' => $description,
                        'position' => $position,
                        'team_num' => $team_num,
                        'role' => $role,
                        'tech' => $tech,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ];
                }
            }
            $this->cvModel->updateProjects($cvId, $projectsData);
        }

        return ["success" => true, "message" => "CV đã được cập nhật thành công"];
    }

    public function deleteCV($cvId)
    {
        if ($this->cvModel->deleteCV($cvId)) {
            with('success', 'Xóa CV thành công!');
            return ["success" => true, "message" => "CV đã được xóa thành công"];
        }
        with('', 'Xóa CV thất bại!');
        return ["success" => false, "errors" => "Không thể xóa CV"];
    }

}