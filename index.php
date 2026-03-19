<?php

session_start();

require_once __DIR__ . "/config.php";
require_once CONTROLLERS_PATH . "AuthController.php";
require_once CONTROLLERS_PATH . "FrontController.php";

$script_directory = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"]));
$page = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$page = str_replace($script_directory, "", $page);
$page = trim($page, "/");

$front_controller = new FrontController();
$front_controller->switch_page($page);

?>
