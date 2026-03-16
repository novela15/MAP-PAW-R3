<?php

session_start();

require_once __DIR__ . "/config.php";
require_once CONTROLLERS_PATH . "AuthController.php";

$page = isset($_GET["page"]) ? $_GET["page"] : "signup";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";

// I feel this will be a giant switch case when all features are combined, but whatever
switch ($page) {
    case "login":
        $controller = new AuthController();
        $controller->login();
        break;
    case "signup":
        $controller = new AuthController();
        $controller->signup();
        break;
    case "budget-account":
        include VIEWS_PATH . "budget-account/budget-account.php";
        break;
}

?>
