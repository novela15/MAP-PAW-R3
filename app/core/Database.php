<?php

// This class is a singleton
class Database {
    private static $instance;
    private $connection;

    private function __construct() {
        $this->connection = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=". DB_NAME .";charset=" . DB_CHARSET,
            DB_USER,
            DB_PASS,
            [
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    private function __clone() {}

    public function __wakeup() {}

    public function getConnection() {
        return $this->connection;
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $sql, array $parameters = []): PDOStatement {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);
        return $statement;
    }
}

?>
