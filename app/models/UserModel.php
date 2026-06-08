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
            [$data["username"], $data["email"], password_hash($data["password_hash"], PASSWORD_DEFAULT), $data["user_id"]]
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

    public function linkToOAuth(string $id, string $email, string $oauth_id, string $method): bool {
        $statement = $this->db->query(
            "UPDATE users SET email = ?, auth_method = ?, oauth_id = ? WHERE id = ?",
            [$email, $method, $oauth_id, $id]
        );
        return $statement->rowCount() > 0;
    }

    public function generatePasswordResetToken(string $email): bool {
        $token = password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT);
        $expiresAt = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $statement = $this->db->query(
            "UPDATE users SET reset_token = ?, reset_token_expire_date = ? WHERE email = ? AND auth_method = 'native'",
            [$token, $expiresAt, $email]
        );

        return $statement->rowCount() > 0;
    }

    public function sendPasswordResetEmail(string $email) {
        if (!$this->generatePasswordResetToken($email)) { return; }

        $user = $this->getUserByEmail($email);
        if (empty($user)) { return; }

        $resetUrl = PASSWORD_RESET_URI . "?token=" . $user["reset_token"] . "&email=" . $user["email"];
        $data = [
            "from" => [
                "email" => "", 
                "name"  => "MAP (Manajemen Anggaran Proyek)"
            ],
            "to" => [
                ["email" => $user["email"]]
            ],
            "subject" => "Reset Password",
            "html"    => "<p>Halo,</p>
                         <p>Tampaknya anda melupakan password untuk MAP (Manajemen Anggaran Proyek). Jika ini benar, klik link di bawah untuk mereset password anda:</p>
                         <p><a href='{$resetUrl}'>{$resetUrl}</a></p>
                         <p>Jika anda tidak merasa ingin melakukan ini, anda bisa mengabaikan email ini.</p>"
        ];

        $ch = curl_init("https://api.mailjet.com/v3.1/send");

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD        => MAILJET_PUBLIC_KEY . ":" . MAILJET_PRIVATE_KEY,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
