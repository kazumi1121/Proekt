<?php

class Database {
    private $host = "localhost";         // или IP, например: "127.0.0.1"
    private $db_name = "phpproekt";  // название базы данных
    private $username = "root"; // имя пользователя БД
    private $password = ""; // пароль пользователя БД

    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );

            // Настройки PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Ошибка подключения к базе данных: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
