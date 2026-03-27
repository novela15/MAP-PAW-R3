<?php

require_once MODELS_PATH . "UserModel.php";

class AuthController {
    private AuthHelper $authHelper;
    private UserModel $userModel;

    public function __construct($authHelper) {
        $this->authHelper = $authHelper;
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["login_email"])) {
            include_once VIEWS_PATH . "auth/login.php";
            exit;
        }

        $email = filter_var(trim($_POST["email_input"], FILTER_SANITIZE_EMAIL));
        $password = $_POST["password_input"] ?? "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Email tidak valid.";
            include_once VIEWS_PATH . "auth/login.php";
            exit;
        }

        $user = $this->userModel->authenticate($email, $password);

        if ($user) {
            $this->authHelper->updateSession($user["id"], $user["username"]);

            header("Location: " . DEFAULT_PAGE);
            exit;
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

            try {
                if ($this->userModel->findUserByEmail($email)) {
                    $email_error = "Email sudah terdaftar.";
                    include_once VIEWS_PATH . "auth/signup.php";
                    exit;
                }

                $newUser = $this->userModel->create([
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                ]);

                $this->authHelper->updateSession($newUser["id"], $username);

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
