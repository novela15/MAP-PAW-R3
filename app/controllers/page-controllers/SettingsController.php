<?php

class SettingsController extends FeaturePageController {
    public function update() {
        if (!isset($_POST)) { return; }

        $controller = new AuthController($this->authHelper);
        $controller->update();
        header("Location: settings");
        exit;
    }

    public function index() {
        $model = new UserModel();
        $userData = $model->getUserById($_SESSION["user_id"]);

        $this->renderView(
            "settings/settings",
            "Settings",
            ["userData" => $userData]
        );
    }
}
