<?php

require_once "../app/core/config.php";
require_once UTILITIES_PATH . "Autoloader.php";

Autoloader::register();

// Replace backslash with slash (if the server runs on Windows)
$script_directory = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"], 2));

$page = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$page = str_replace($script_directory, "", $page);
$page = trim($page, "/");

try {
    $front_controller = new FrontController();
    $front_controller->render($page);
} catch (Exception $exception) {
    echo "<h1>500 Something went wrong.</h1>";
}

?>
