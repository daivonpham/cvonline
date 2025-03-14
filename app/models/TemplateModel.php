<?php

namespace App\Models;
use Config\Database;
use PDO;


class TemplateModel{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function getAll(){
        $query = "SELECT * FROM template";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($templateId)
    {
        $query = "SELECT * FROM template WHERE template_id = :template_id";
        $stmt = $this->db->prepare($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

}