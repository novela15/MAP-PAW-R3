<?php

class AuthController {
    private AuthHelper $authHelper;
    private UserModel $userModel;
    private Validator $validator;

    public function __construct() {
        $this->authHelper = new AuthHelper();
        $this->userModel = new UserModel();
        $this->validator = new Validator();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !$this->validator->validateArray($_POST)) {
            $this->authHelper->clearMessages();

            foreach ($this->validator->getErrors() as $key => $value) {
                $this->authHelper->setMessage($key . "_error", $value);
            }

            header("Location: login");
            exit;
        }

        $user = $this->userModel->authenticate($_POST["email_input"], $_POST["password_input"]);

        if (!empty($user)) {
            $this->authHelper->updateSession($user["id"], $user["username"]);
            $this->authHelper->clearMessages();
            header("Location: " . DEFAULT_PAGE);
            exit;
        } else {
            $this->authHelper->setMessage("email_error", "Email atau password salah.");
            $this->authHelper->setMessage("password_error", "Email atau password salah.");
            header("Location: login");
            exit;
        }
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !$this->validator->validateArray($_POST)) {
            foreach ($this->validator->getErrors() as $key => $value) {
                $this->authHelper->setMessage($key . "_error", $value);
            }

            header("Location: signup");
            exit;
        }

        if (!empty($this->userModel->getUserByEmail($_POST["email_input"]))) {
            $this->authHelper->setMessage("email_error", "Email tidak valid.");
            header("Location: signup");
            exit;
        }

        $newUser = $this->userModel->create([
            "username" => $_POST["username_input"],
            "email" => $_POST["email_input"],
            "password_hash" => $_POST["password_input"],
        ]);

        $this->authHelper->updateSession($newUser["id"], $_POST["username_input"]);
        $this->authHelper->clearMessages();
        header("Location: " . DEFAULT_PAGE);
        exit;
    }

    public function update() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !$this->validator->validateArray($_POST)) {
            foreach ($this->validator->getErrors() as $key => $value) {
                $this->authHelper->setMessage($key . "_error", $value);
            }

            header("Refresh: 0");
            exit;
        }

        if (empty($this->userModel->getUserByEmail($_POST["email_input"]))) {
            $this->authHelper->setMessage("email_error", "Email tidak valid.");
            header("Refresh: 0");
            exit;
        }

        $newUser = $this->userModel->update([
            "username" => $_POST["username_input"],
            "email" => $_POST["email_input"],
            "password_hash" => $_POST["password_input"],
        ]);

        $this->authHelper->updateSession($newUser["id"], $_POST["username_input"]);
        $this->authHelper->clearMessages();
        header("Refresh: 0");
        exit;
    }

    public function logout() {
        $this->authHelper->destroySession();
        header("Location: login");
        exit;
    }
}
