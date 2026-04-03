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

    if ($exception instanceof PageNotFoundException) {
        http_response_code(404);
    } else {
        http_response_code(500);
    }

    if (file_exists(ERROR_PAGES_PATH . http_response_code() . ".php")) {
        require_once ERROR_PAGES_PATH . http_response_code() .".php";
    } else {
        echo "<h1>Error " . http_response_code() . ".</h1>";
    }
}

?>
