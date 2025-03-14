<?php
namespace App\Models;

use Config\Database;
use PDO;

class Connect
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

    }

    public function testConnection(): string
    {
        return $this->db instanceof PDO ? "✅ Kết nối Database thành công!" : "❌ Kết nối thất bại!";
    }
}
?>