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
    $router = new Router();

    require_once CORE_PATH . "routes.php";

    $router->resolve($page, $_SERVER["REQUEST_METHOD"]);
} catch (Exception $exception) {
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    if ($exception instanceof RequestException) {
        http_response_code($exception->getResponseCode());
    } else {
        http_response_code(500);
    }

    if (file_exists(ERROR_PAGES_PATH ."error.php")) {
        require_once ERROR_PAGES_PATH . "error.php";
    } else {
        echo "<h1>Error " . http_response_code() . "</h1>";
    }
}
