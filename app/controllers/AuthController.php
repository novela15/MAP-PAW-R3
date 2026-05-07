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

    public function handleGoogleAuth() {
        if (!IS_GOOGLE_AUTH_ENABLED) {
            exit;
        }

        $this->authHelper->clearMessages();

        if (isset($_GET["code"]) && !empty($_GET["code"])) {
            $params = [
                "code" => $_GET["code"],
                "client_id" => GOOGLE_OAUTH_CLIENT_ID,
                "client_secret" => GOOGLE_OAUTH_CLIENT_SECRET,
                "redirect_uri" => GOOGLE_OAUTH_REDIRECT_URI,
                "grant_type" => "authorization_code"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://accounts.google.com/o/oauth2/token");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($response, true);

            if (isset($response["access_token"]) && !empty($response["access_token"])) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/" . GOOGLE_OAUTH_CLIENT_VERSION . "/userinfo");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $response["access_token"]]);

                $response = curl_exec($ch);
                curl_close($ch);

                $profile = json_decode($response, true);

                if (isset($profile["email"])) {
                    $google_name_parts = [];
                    $google_name_parts[] = isset($profile["given_name"]) ? preg_replace("/[^a-zA-Z0-9]/s", "", $profile["given_name"]) : "";
                    $google_name_parts[] = isset($profile["family_name"]) ? preg_replace("/[^a-zA-Z0-9]/s", "", $profile["family_name"]) : "";
                    session_regenerate_id();

                    $_SESSION["google_email"] = $profile["email"];

                    if (empty($this->userModel->getUserByEmail($profile["email"]))) {
                        $newUser = $this->userModel->create([
                            "username" => implode(' ', $google_name_parts),
                            "email" => $profile["email"],
                            "password_hash" => "",
                        ]);

                        $this->authHelper->updateSession($newUser["id"], $newUser["username"]);
                    } else {
                        $user = $this->userModel->authenticate($profile["email"], "");
                        $this->authHelper->updateSession($user["id"], $user["username"]);
                    }

                    header("Location: " . DEFAULT_PAGE);
                    exit;
                } else {
                    $this->authHelper->setMessage("google_auth_error", "Google OAuth mengalami error. Silakan coba lagi.");
                }
            } else {
                $this->authHelper->setMessage("google_auth_error", "Google OAuth mengalami error. Silakan coba lagi.");
            }
        } else {
            $params = [
                "response_type" => "code",
                "client_id" => GOOGLE_OAUTH_CLIENT_ID,
                "redirect_uri" => GOOGLE_OAUTH_REDIRECT_URI,
                "scope" => "https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
                "access_type" => "offline",
                "prompt" => "consent"
            ];
            header("Location: https://accounts.google.com/o/oauth2/auth?" . http_build_query($params));
            exit;
        }
    }
}
