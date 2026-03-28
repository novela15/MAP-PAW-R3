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

    public function destroySession() {
        session_unset();
        session_destroy();
    }

    public function updateSession(string $id, string $name) {
        $_SESSION["user_id"] = $id;
        $_SESSION["user_name"] = $name;
    }
}

?>
