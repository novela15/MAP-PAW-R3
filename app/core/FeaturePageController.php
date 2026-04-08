<?php

abstract class FeaturePageController {
    protected AuthHelper $authHelper;

    public function __construct() {
        $this->authHelper = new AuthHelper();
    }

    protected function renderView(string $viewName, string $title, array $data = []) {
        extract($data);

        $pageContent = VIEWS_PATH . $viewName . ".php";
        $pageTitle = $title;

        $messages = $this->authHelper->getAllMessages();

        require_once SKELETON_PATH . "skeleton.php";
    }
}

