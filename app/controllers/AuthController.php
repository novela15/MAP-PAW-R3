<?php

class AuthController {
    private AuthHelper $authHelper;
    private UserModel $userModel;
    private Validator $validator;

    public function __construct($authHelper) {
        $this->authHelper = $authHelper;
        $this->userModel = new UserModel();
        $this->validator = new Validator();
    }

    public function login() {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["login_email"])) {
            include_once VIEWS_PATH . "auth/login.php";
            exit;
        }

        if (!$this->validator->validateArray($_POST)) {
            $errors = $this->validator->getErrors();
            include_once VIEWS_PATH . "auth/login.php";
            exit;
        }

        $user = $this->userModel->authenticate($_POST["email_input"], $_POST["password_input"]);

        if ($user) {
            $this->authHelper->updateSession($user["id"], $user["username"]);
            header("Location: " . DEFAULT_PAGE);
            exit;
        } else {
            $errors["password"] = "Email atau password salah.";
            include_once VIEWS_PATH . "auth/login.php";
        }
    }

    public function signup() {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["signup_email"])) {
            include_once VIEWS_PATH . "auth/signup.php";
            return;
        }

        if (!$this->validator->validateArray($_POST)) {
            $errors = $this->validator->getErrors();
            include_once VIEWS_PATH . "auth/signup.php";
            exit;
        }

        try {
            if ($this->userModel->getUserByEmail($_POST["email_input"])) {
                $errors["email"] = "Email tidak valid.";
                include_once VIEWS_PATH . "auth/signup.php";
                exit;
            }

            $newUser = $this->userModel->create([
                "username" => $_POST["username_input"],
                "email" => $_POST["email_input"],
                "password" => $_POST["password_input"],
            ]);

            $this->authHelper->updateSession($newUser["id"], $_POST["username_input"]);
            header("Location: " . DEFAULT_PAGE);
            exit;
        } catch (PDOException $exception) {
            die("Database Connection Error: "  . $exception->getMessage());
        }
    }

    public function logout() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout_button"])) {
            $this->authHelper->destroySession();
            header("Location: login");
            exit;
        }
    }
}

?>
