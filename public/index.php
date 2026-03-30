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
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    http_response_code(500);

    echo "<h1>500 Something went wrong.</h1>";

    if (ENVIRONMENT === "dev") {
        echo $exception->getMessage();
    }
}

?>
