<?php

session_start();

// Core
require_once __DIR__ . "/core/config.php";
require_once __DIR__ . "/core/Database.php";

// Controllers
require_once CONTROLLERS_PATH . "FrontController.php";
require_once CONTROLLERS_PATH . "AuthController.php";

// Replace backslash with slash (if the server runs on Windows)
$script_directory = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"]));

$page = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$page = str_replace($script_directory, "", $page);
$page = trim($page, "/");

try {
    $front_controller = new FrontController();

    if (isset($_SESSION["user_id"]) && ($page === "login" || $page === "signup")) {
        header("Location: " . DEFAULT_PAGE);
    } else {
        $front_controller->switchPage($page);
    }
} catch (Exception $exception) {
    echo "Something went wrong.";
}

?>
