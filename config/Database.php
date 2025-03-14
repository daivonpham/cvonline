<?php
namespace Config;
use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private $pdo;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); 
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname";

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("❌ Lỗi kết nối database: " . $e->getMessage());
        }
    }

    // Hàm lấy kết nối PDO
    public function getConnection()
    {
        return $this->pdo;
    }

    // Hàm query đơn giản (dùng cho SELECT)
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Hàm insert/update/delete (dùng cho INSERT, UPDATE, DELETE)
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
?>