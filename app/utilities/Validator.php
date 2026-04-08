<?php

class Validator {
    private array $errors = [];

    private function email(string $email, array $data) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = "Email tidak valid.";
        }
    }

    private function password(string $password, array $data) {
        if (!isset($data["password_confirm_input"])) { return; }

        if (strlen($password) < 6 || strlen($data["password_confirm_input"]) < 6) {
            $this->errors["password"] = "Password minimal 6 karakter.";
        }

        if ($password !== $data["password_confirm_input"]) {
            $this->errors["password"] = "Password tidak cocok.";
        }
    }

    private function username(string $value, array $data) {
        if (empty(trim($value))) {
            $this->errors["username"] = "Username tidak boleh kosong.";
        }
    }

    public function validateArray(array $data): bool {
        $this->errors = [];

        foreach ($data as $key => $value) {
            if (str_ends_with($key, "_input")) {
                $method = substr($key, 0, -strlen("_input"));

                if (method_exists($this, $method)) {
                    $this->$method($value, $data);
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
