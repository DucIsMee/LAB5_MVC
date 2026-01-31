<?php
class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Kết nối tới database bằng PDO
     */
    protected function connect()
    {
        try {
            // Cấu hình database
            $host = 'localhost';
            $db = 'lab5_mvc';
            $user = 'root';
            $pass = '';
            
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Lỗi kết nối database: " . $e->getMessage());
        }
    }

    /**
     * Kiểm tra xem có kết nối PDO hay không
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}
?>