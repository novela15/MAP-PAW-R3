<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function authenticate(string $email, string $password): array|bool {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user["password_hash"])) {
            return $user;
        }

        return false;
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)",
            [$data["username"], $data["email"], password_hash($data["password_hash"], PASSWORD_DEFAULT)]
        );

        return $this->getUserById($this->db->getConnection()->lastInsertId());
    }

    public function update(array $data): array {
        $this->db->query(
            "UPDATE users SET username = ?, email = ?, password_hash = ? WHERE id = ?",
            [$data["username"], $data["email"], password_hash($data["password_hash"], PASSWORD_DEFAULT), $_SESSION["user_id"]]
        );

        return $this->getUserById($_SESSION["user_id"]);
    }

    public function getUserByEmail(string $email): array {
        $statement = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
        return $statement->fetch() ?: [];
    }

    public function getUserById(string $id): array {
        $statement = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        return $statement->fetch() ?: [];
    }
}

?>
