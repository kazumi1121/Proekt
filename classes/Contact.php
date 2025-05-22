<?php
require_once __DIR__ . '/../config/Database.php';

$db = new Database();
$conn = $db->getConnection();

class Contact {
    private $conn;
    private $table = "contacts";

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function create($name, $email, $message) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name, email, message) VALUES (:name, :email, :message)");
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);
        } catch (PDOException $e) {
            echo "Ошибка при вставке: " . $e->getMessage();
            return false;
        }
    }    

    public function readAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса: " . implode(", ", $this->conn->errorInfo()));
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: []; // Возвращаем пустой массив, если данных нет
    }
}