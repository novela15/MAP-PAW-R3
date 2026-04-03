<?php

class SettingsController {
    private AuthHelper $authHelper;
    private UserModel $userModel;
    private Validator $validator;

    public function __construct($authHelper) {
        $this->authHelper = $authHelper;
        $this->userModel = new UserModel();
        $this->validator = new Validator();
    }

    public function start() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm_button"])) {
            
        }
    }
}

?>
