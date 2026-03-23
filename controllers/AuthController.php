<?php

class AuthController {
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login_email"])) {
            $email = filter_var(trim($_POST["email_input"], FILTER_SANITIZE_EMAIL));
            $password = $_POST["password_input"] ?? "";

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Email tidak valid.";
                include_once VIEWS_PATH . "auth/login.php";
                exit;
            }

            $db = Database::getInstance();
            $user = $db->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();

            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = $user["id"];
                header("Location: " . DEFAULT_PAGE);
                exit;
            } else {
                include_once VIEWS_PATH . "auth/login.php";
            }
        } else {
            include_once VIEWS_PATH . "auth/login.php";
        }
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["signup_email"])) {
            $username = htmlspecialchars(trim($_POST["username_input"] ?? ""));
            $email = filter_var(trim($_POST["email_input"], FILTER_SANITIZE_EMAIL));
            $password = $_POST["password_input"] ?? "";
            $confirm = $_POST["password_confirm_input"] ?? "";

            if (empty($username)) {
                $username_error = "Username tidak boleh kosong.";
                include_once VIEWS_PATH . "auth/signup.php";
                exit;
            }

            if ($password !== $confirm) {
                $password_error = "Password tidak cocok.";
                include_once VIEWS_PATH . "auth/signup.php";
                exit;
            }

            if (strlen($password) < 6 || strlen($confirm) < 6) {
                $password_error = "Password minimal 6 karakter.";
                include_once VIEWS_PATH . "auth/signup.php";
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Email tidak valid.";
                include_once VIEWS_PATH . "auth/signup.php";
                exit;
            }

            $db = Database::getInstance();

            try {
                $email_check = $db->query("SELECT id FROM users WHERE email = ?", [$email])->fetch();

                if ($email_check) {
                    $email_error = "Email sudah terdaftar.";
                    include_once VIEWS_PATH . "auth/signup.php";
                    exit;
                }

                $db->query(
                    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)",
                    [$username, $email, password_hash($password, PASSWORD_DEFAULT)]
                );

                $_SESSION["user_id"] = $db->getConnection()->lastInsertId();

                header("Location: " . DEFAULT_PAGE);
                exit;
            } catch (PDOException $exception) {
                die("Database Connection Error: "  . $exception->getMessage());
            }
        } else {
            include_once VIEWS_PATH . "auth/signup.php";
        }
    }

    public function logout() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout_button"])) {
            session_unset();
            session_destroy();
            header("Location: login");
            exit;
        }
    }
}

?>
