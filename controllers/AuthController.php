<?php

// Warning: Server sided sanity checks don't exist yet
class AuthController {
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            header("Location: budget-account");
        } else {
            include VIEWS_PATH . "auth/login.php";
        }
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            header("Location: budget-account");
        } else {
            include VIEWS_PATH . "auth/signup.php";
        }
    }
}

?>
