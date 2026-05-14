<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function authenticate(string $email, string $password): array|bool {
        $user = $this->getUserByEmail($email);

        if (!$user || empty($user["password_hash"])) {
            return false;
        }

        if ($user && password_verify($password, $user["password_hash"])) {
            return $user;
        }

        return false;
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO users (username, email, password_hash, auth_method, oauth_id) VALUES (?, ?, ?, ?, ?)",
            [
                $data["username"],
                $data["email"],
                password_hash($data["password_hash"], PASSWORD_DEFAULT),
                $data["auth_method"] ?? "native",
                $data["oauth_id"] ?? ""
            ],
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

    public function getUserByOAuthId(string $oauth_id, string $method): array {
        $statement = $this->db->query("SELECT * FROM users WHERE auth_method = ? AND oauth_id = ?", [$method, $oauth_id]);
        return $statement->fetch() ?: [];
    }

    public function linkToOAuth(string $id, string $email, string $oauth_id, string $method) {
        $statement = $this->db->query("UPDATE users SET email = ?, auth_method = ?, oauth_id = ? WHERE id = ?", [$email, $method, $oauth_id, $id]);
        return $this->getUserByOAuthId($oauth_id, $method);
    }
}
