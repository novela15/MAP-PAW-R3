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

    public function updateSession(string $id, string $name) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $id;
        $_SESSION["user_name"] = $name;
    }
}

?>
