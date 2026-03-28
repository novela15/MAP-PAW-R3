<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function authenticate(string $email, string $password): array|bool {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user["password"])) {
            return $user;
        }

        return false;
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
            [$data["username"], $data["email"], password_hash($data["password"], PASSWORD_DEFAULT)]
        );

        return $this->getUserById($this->db->getConnection()->lastInsertId());
    }

    public function getUserByEmail(string $email): array|bool {
        $statement = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
        if (!$statement) { return false; }

        return $statement->fetch();
    }

    public function getUserById(string $id): array|bool {
        $statement = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$statement) { return false; }

        return $statement->fetch();
    }
}

?>
