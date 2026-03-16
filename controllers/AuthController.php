<?php

class AuthController {
    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

        }

        include VIEWS_PATH . "auth/signup.php";
    }
}

?>
