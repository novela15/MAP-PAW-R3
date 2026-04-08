<?php

class SettingsController extends FeaturePageController {
    public function update() {
        $controller = new AuthController($this->authHelper);
        $controller->update();
        header("Location: settings");
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
