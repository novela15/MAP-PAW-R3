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
            $this->authHelper->clearMessages();

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
            "auth_method" => "native",
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

        if (empty($this->userModel->getUserById($_SESSION["user_id"]))) {
            $this->authHelper->setMessage("email_error", "Email tidak valid.");
            header("Refresh: 0");
            exit;
        }

        $newUser = $this->userModel->update([
            "user_id" => $_SESSION["user_id"],
            "username" => $_POST["username_input"],
            "email" => $_POST["email_input"],
            "password_hash" => $_POST["password_input"],
        ]);

        $this->authHelper->updateSession($newUser["id"], $newUser["username"]);
        $this->authHelper->clearMessages();
        header("Refresh: 0");
        exit;
    }

    public function logout() {
        $this->authHelper->destroySession();
        header("Location: login");
        exit;
    }

    public function handleGoogleAuth($isLinking = false) {
        $isConfigMissing = !defined("GOOGLE_OAUTH_CLIENT_ID")
            || !defined("GOOGLE_OAUTH_CLIENT_SECRET")
            || !defined("GOOGLE_OAUTH_REDIRECT_URI");

        if (IS_GOOGLE_AUTH_ENABLED && $isConfigMissing) {
            throw new RequestException(500, "Masalah internal server.");
            exit;
        }

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

            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (isset($response["access_token"]) && !empty($response["access_token"])) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/" . GOOGLE_OAUTH_CLIENT_VERSION . "/userinfo");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $response["access_token"]]);

                $profile = json_decode(curl_exec($ch), true);
                curl_close($ch);

                $googleId = $profile["id"] ?? $profile["sub"] ?? null;

                if (isset($googleId) && isset($profile["email"])) {
                    $google_name_parts = [];
                    $google_name_parts[] = isset($profile["given_name"]) ? preg_replace("/[^a-zA-Z0-9]/s", "", $profile["given_name"]) : "";
                    $google_name_parts[] = isset($profile["family_name"]) ? preg_replace("/[^a-zA-Z0-9]/s", "", $profile["family_name"]) : "";

                    if ($isLinking) {
                        if (isset($_SESSION["user_id"])) {
                            $this->userModel->linkToOAuth($_SESSION["user_id"], $profile["email"], $googleId, "google");

                            $modifiedUser = $this->userModel->getUserByOAuthId($googleId, "google");

                            if ($modifiedUser) {
                                header($_SERVER["HTTP_REFERER"]);
                                exit;
                            } else {
                                $this->authHelper->updateSession($modifiedUser["id"], $modifiedUser["username"]);
                            }
                        }
                    } else {
                        if (empty($this->userModel->getUserByEmail($profile["email"]))) {
                            $newUser = $this->userModel->create([
                                "username" => implode(' ', $google_name_parts),
                                "email" => $profile["email"],
                                "password_hash" => "",
                                "auth_method" => "google",
                                "oauth_id" => $googleId,
                            ]);

                            $this->authHelper->updateSession($newUser["id"], $newUser["username"]);
                        } else {
                            $user = $this->userModel->getUserByOAuthId($googleId, "google");

                            if (empty($user)) {
                                $this->authHelper->updateSession($user["id"], $user["username"]);
                            } else {
                                $this->authHelper->setMessage("google_auth_error", "Gagal mengautentikasi user.");
                                header("Location: login");
                                exit;
                            }
                        }
                    }

                    header("Location: " . DEFAULT_PAGE);
                    exit;
                } else {
                    $this->authHelper->setMessage("google_auth_error", "Akun Google tidak ditemukan.");
                }
            } else {
                $this->authHelper->setMessage("google_auth_error", "Google OAuth mengalami error. Silakan coba lagi.");
            }

            header("Location: login");
            exit;
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

    public function linkToGoogleOAuth() {
        if (!isset($_SESSION["user_id"])) {
            header($_SERVER["HTTP_REFERER"]);
            exit;
        }

        $this->handleGoogleAuth(true);
    }

    public function resetPassword() {
        $this->authHelper->clearMessages();

        if (!isset($_GET["email"]) || !isset($_GET["token"])) {
            $this->authHelper->setMessage("password_reset_error", "Link untuk mereset password tidak valid.");
            include_once VIEWS_PATH . "auth/reset-password.php";
            exit;
        }

        $user = $this->userModel->getUserByEmail($_GET["email"]);
        $isInvalid = empty($user["reset_token_expire_date"])
            || strtotime($user["reset_token_expire_date"] . " UTC") < time()
            || $_GET["token"] !== $user["reset_token"];

        if ($isInvalid) {
            $this->authHelper->setMessage("password_reset_error", "Link untuk mereset password tidak valid.");
            header("Location: reset-password");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $newUser = $this->userModel->resetPassword([
                "id" => $user["id"],
                "password" => $_POST["password_input"],
            ]);

            $this->authHelper->clearMessages();
            header("Location: login");
            exit;
        } else {
            include_once VIEWS_PATH . "auth/reset-password.php";
        }
    }

    public function sendPasswordResetEmail() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !$this->validator->validateArray($_POST)) {
            $this->authHelper->clearMessages();

            foreach ($this->validator->getErrors() as $key => $value) {
                $this->authHelper->setMessage($key . "_error", $value);
            }

            header("Location: request-password-reset");
            exit;
        }

        $user = $this->userModel->getUserByEmail($_POST["email_input"]);

        if (empty($user)) {
            $this->authHelper->setMessage("email_error", "Email tidak valid.");
            header("Location: request-password-reset");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isSuccess = $this->userModel->sendPasswordResetEmail($_POST["email_input"]);

            if ($isSuccess) {
                $this->authHelper->setMessage("request_password_reset", "Email berhasil dikirim.");
            } else {
                $this->authHelper->setMessage("request_password_reset", "Gagal mengirim email.");
            }

            include_once VIEWS_PATH . "auth/request-password-reset.php";
        }
    }
}
