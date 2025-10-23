<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require_once __DIR__ . '/../../config/config.php';
        $this->connection = new PDO(
            "mysql:host={$config['db_host']};dbname={$config['db_name']}",
            $config['db_user'],
            $config['db_pass']
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>