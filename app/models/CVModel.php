<?php

namespace App\Models;

use Config\Database;
use PDO;

class CVModel
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function getCVById($userId)
    {
        $query = "SELECT * FROM cv WHERE user_id = $userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCVById($userId)
    {
        $query = "SELECT c.cv_id, c.name, c.update_at, c.target, u.fullname, u.major, t.theme 
        FROM cv c 
        LEFT JOIN user u ON c.user_id = u.user_id 
        LEFT JOIN template t ON c.template_id = t.template_id 
        WHERE c.user_id = $userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateTemplateCV($cvId, $templateId)
    {
        $params = [
            ':template_id' => $templateId,
            ':cv_id' => $cvId,
        ];
        $query = "UPDATE cv SET template_id = :template_id WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);


    }

    // ADD

    public function createCV($name, $cv_link, $userId, $target = null)
    {
        $params = [
            ':name' => $name,
            ':cv_link' => $cv_link,
            ':userId' => $userId,
            ':template_id' => 1,
            ':target' => $target ?: null,
        ];

        $query = "INSERT INTO cv (name, cv_link, user_id, template_id, target) 
              VALUES (:name, :cv_link, :userId, :template_id, :target)";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $this->db->lastInsertId();
    }

    public function addSkills($name_skill, $skills, $cv_id)
    {
        $params = [
            ':name_skill' => $name_skill ?: null,
            ':skills' => $skills ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO skills (name_skill, skills, cv_id) VALUES (:name_skill, :skills, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addEducation($school, $major, $achievements, $start_date, $end_date, $cv_id)
    {
        $params = [
            ':school' => $school ?: null,
            ':major' => $major ?: null,
            ':achievements' => $achievements ?: null,
            ':start_date' => $start_date ?: null,
            ':end_date' => $end_date ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO education (school, major, achievements, start_date, end_date, cv_id) 
                  VALUES (:school, :major, :achievements, :start_date, :end_date, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addWorkExperience($company, $position, $description, $start_date, $end_date, $cv_id)
    {
        $params = [
            ':company' => $company ?: null,
            ':position' => $position ?: null,
            ':description' => $description ?: null,
            ':start_date' => $start_date ?: null,
            ':end_date' => $end_date ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO work_experience (company, position, description, start_date, end_date, cv_id) 
                  VALUES (:company, :position, :description, :start_date, :end_date, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addLanguage($name, $cv_id)
    {
        $params = [
            ':name' => $name ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO language (name, cv_id) VALUES (:name, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }
    public function addCertificate($name, $date, $cv_id)
    {
        $params = [
            ':name' => $name ?: null,
            ':date' => $date ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO certificates (name, date, cv_id) VALUES (:name, :date, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addAward($name, $date, $description, $cv_id)
    {
        $params = [
            ':name' => $name ?: null,
            ':date' => $date ?: null,
            ':description' => $description ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO awards (name, date, description, cv_id) 
                  VALUES (:name, :date, :description, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addActivity($name, $date, $description, $cv_id)
    {
        $params = [
            ':name' => $name ?: null,
            ':date' => $date ?: null,
            ':description' => $description ?: null,
            ':cv_id' => $cv_id
        ];

        $query = "INSERT INTO activities (name, date, description, cv_id) 
                  VALUES (:name, :date, :description, :cv_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function addProject($name, $description, $position, $team_num, $role, $tech, $start_date, $end_date, $cv_id)
    {
        $query = "INSERT INTO project (name, description, position, team_num, role, tech, start_date, end_date, cv_id) 
          VALUES (:name, :description, :position, :team_num, :role, :tech, :start_date, :end_date, :cv_id)";

        $params = [
            ':name' => $name,
            ':description' => $description,
            ':position' => $position,
            ':team_num' => $team_num,
            ':role' => $role,
            ':tech' => $tech,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':cv_id' => $cv_id
        ];

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    //UPDATE

    public function getCVShowById($cvId)
    {
        $query = "SELECT * FROM cv WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getSkillsByCVId($cvId)
    {
        $query = "SELECT * FROM skills WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEducationByCVId($cvId)
    {
        $query = "SELECT * FROM education WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWorkExperienceByCVId($cvId)
    {
        $query = "SELECT * FROM work_experience WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLanguageByCVId($cvId)
    {
        $query = "SELECT * FROM language WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCertificatesByCVId($cvId)
    {
        $query = "SELECT * FROM certificates WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAwardsByCVId($cvId)
    {
        $query = "SELECT * FROM awards WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivitiesByCVId($cvId)
    {
        $query = "SELECT * FROM activities WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectsByCVId($cvId)
    {
        $query = "SELECT * FROM project WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_id' => $cvId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE

    public function updateCV($cvId, $data)
    {
        $params = [
            ':name' => $data['name'] ?? null,
            ':cv_link' => $data['cv_link'] ?? null,
            ':target' => $data['target'] ?? null,
            ':cv_id' => $cvId
        ];

        $query = "UPDATE cv SET name = :name, cv_link = :cv_link, target = :target 
              WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }
    public function updateSkills($cvId, $skillsData)
    {
        // Xóa tất cả kỹ năng cũ của CV
        $deleteQuery = "DELETE FROM skills WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        // Thêm lại các kỹ năng mới (sử dụng phương thức addSkills đã có)
        foreach ($skillsData as $skill) {
            $this->addSkills($skill['name_skill'], $skill['skills'], $cvId);
        }
    }

    public function updateEducation($cvId, $educationData)
    {
        $deleteQuery = "DELETE FROM education WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($educationData as $edu) {
            $this->addEducation($edu['school'], $edu['major'], $edu['achievements'], $edu['start_date'], $edu['end_date'], $cvId);
        }
    }
    public function updateWorkExperience($cvId, $workExpData)
    {
        $deleteQuery = "DELETE FROM work_experience WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($workExpData as $work) {
            $this->addWorkExperience($work['company'], $work['position'], $work['description'], $work['start_date'], $work['end_date'], $cvId);
        }
    }

    public function updateLanguage($cvId, $languageData)
    {
        $deleteQuery = "DELETE FROM language WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($languageData as $lang) {
            $this->addLanguage($lang['name'], $cvId);
        }
    }

    public function updateCertificates($cvId, $certificatesData)
    {
        $deleteQuery = "DELETE FROM certificates WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($certificatesData as $cert) {
            $this->addCertificate($cert['name'], $cert['date'], $cvId);
        }
    }

    public function updateAwards($cvId, $awardsData)
    {

        $deleteQuery = "DELETE FROM awards WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($awardsData as $award) {
            $this->addAward($award['name'], $award['date'], $award['description'], $cvId);
        }
    }

    public function updateActivities($cvId, $activitiesData)
    {
        $deleteQuery = "DELETE FROM activities WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($activitiesData as $activity) {
            $this->addActivity($activity['name'], $activity['date'], $activity['description'], $cvId);
        }
    }

    public function updateProjects($cvId, $projectsData)
    {
        $deleteQuery = "DELETE FROM project WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([':cv_id' => $cvId]);

        foreach ($projectsData as $project) {
            $this->addProject($project['name'], $project['description'], $project['position'], $project['team_num'], $project['role'], $project['tech'], $project['start_date'], $project['end_date'], $cvId);
        }
    }


    public function deleteCV($cvId)
    {
        $query = "DELETE FROM cv WHERE cv_id = :cv_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':cv_id' => $cvId]);
    }

    //show cv by cv_link
    public function getCVByLink($cvLink)
    {
        $query = "SELECT * FROM cv c 
        LEFT JOIN user u ON c.user_id = u.user_id 
        LEFT JOIN social_link sl ON u.user_id = sl.user_id 
        WHERE cv_link = :cv_link";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':cv_link' => $cvLink]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLink($userId)
    {
        $query = "SELECT * FROM social_link WHERE user_id = $userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isCvLinkUnique($cvLink, $cvId = null)
    {
        $query = "SELECT COUNT(*) FROM cv WHERE cv_link = :cv_link";
        if ($cvId) {
            $query .= " AND cv_id != :cv_id";
        }
        $stmt = $this->db->prepare($query);
        $params = [':cv_link' => $cvLink];
        if ($cvId) {
            $params[':cv_id'] = $cvId;
        }
        $stmt->execute($params);
        return $stmt->fetchColumn() == 0;
    }
}

