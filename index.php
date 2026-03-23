<?php

session_start();

// Core
require_once __DIR__ . "/core/config.php";

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
    $front_controller->switch_page($page);
} catch (Exception $exception) {
    echo "Something went wrong.";
}

?>
