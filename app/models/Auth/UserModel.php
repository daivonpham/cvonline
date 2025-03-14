<?php

namespace App\Models\Auth;

use Config\Database;
use PDO;

class UserModel{

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
    public function register($username, $email, $password)
    {
        $query = "INSERT INTO user (username, password, email, create_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$username, $password, $email]);
    }

    public function updateProfile($userId, $fullname, $nickname, $birthday, $gender, $phone, $address, $major, $website, $avatar)
    {
        $query = "UPDATE user SET fullname = :fullname, nickname = :nickname, birthday = :birthday, gender = :gender, phone = :phone, address = :address, major = :major, website = :website, avatar = :avatar WHERE user_id = :userId";
        $stmt = $this->db->prepare($query); 
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':major', $major);
        $stmt->bindParam(':website', $website);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':userId', $userId);
        return $stmt->execute();
    }

    public function addSocialLink($userId, $platform, $url)
    {
        $query = "INSERT INTO social_link (user_id, platform, url) VALUES (:userId, :platform, :url)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':platform', $platform);
        $stmt->bindParam(':url', $url);
        return $stmt->execute();
    }

    public function updateSocialLink($linkId, $platform, $url)
    {
        $query = "UPDATE social_link SET platform = :platform, url = :url WHERE link_id = :linkId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':linkId', $linkId);
        $stmt->bindParam(':platform', $platform);
        $stmt->bindParam(':url', $url);
        return $stmt->execute();
    }

    public function getSocialLinks($userId)
    {
        $stmt = $this->db->prepare("SELECT link_id, platform, url FROM social_link WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSocialLink($linkId)
    {
        $stmt = $this->db->prepare("DELETE FROM social_link WHERE link_id = :linkId");
        $stmt->bindParam(':linkId', $linkId);
        return $stmt->execute();
    }

    public function findById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}