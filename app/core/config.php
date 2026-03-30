<?php

define("SERVER_ROOT_PATH", dirname(__FILE__, 3) . DIRECTORY_SEPARATOR);
define("APP_PATH", dirname(__FILE__, 2) . DIRECTORY_SEPARATOR);
define("PUBLIC_PATH", SERVER_ROOT_PATH . "public" . DIRECTORY_SEPARATOR);

define("ASSETS_PATH", PUBLIC_PATH . "assets" . DIRECTORY_SEPARATOR);
define("FRONTEND_PATH", PUBLIC_PATH . "frontend" . DIRECTORY_SEPARATOR);

define("CONTROLLERS_PATH", APP_PATH. "controllers" . DIRECTORY_SEPARATOR);
define("CORE_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("MODELS_PATH", APP_PATH. "models" . DIRECTORY_SEPARATOR);
define("UTILITIES_PATH", APP_PATH. "utilities" . DIRECTORY_SEPARATOR);
define("VIEWS_PATH", APP_PATH. "views" . DIRECTORY_SEPARATOR);

define("SKELETON_PATH", VIEWS_PATH . "skeleton" . DIRECTORY_SEPARATOR);

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "map");
define("DB_CHARSET", "utf8mb4");

define("ENVIRONMENT", "dev");

define("DEFAULT_PAGE", "budget-account");
define("NO_SESSION_PAGES", ["login", "signup"]); // Pages forbidden to access while being logged in
define("PUBLIC_PAGES", ["login", "signup"]); // Pages accessible without being logged in

?>
