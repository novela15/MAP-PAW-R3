<?php

class AuthHelper {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLoggedIn(): bool {
        return isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]);
    }

    public function destroySession(): void {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

    public function updateSession(string $id, string $name): void {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $id;
        $_SESSION["user_name"] = $name;
    }

    public function clearMessages(): void {
        unset($_SESSION["messages"]);
    }

    public function getAllMessages(): array {
        $messages = $_SESSION["messages"] ?? [];
        unset($_SESSION["messages"]);
        return $messages;
    }

    public function getMessage(string $key): array {
        return $_SESSION["messages"][$key] ?? [];
    }

    public function setAllMessages(array $array): void {
        $_SESSION["messages"] = $array;
    }

    public function setMessage(string $key, $value): void {
        $_SESSION["messages"][$key] = $value;
    }
}
