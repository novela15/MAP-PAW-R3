<?php

// File Paths //
define("SERVER_ROOT_PATH", dirname(__FILE__, 3) . DIRECTORY_SEPARATOR);
define("APP_PATH", dirname(__FILE__, 2) . DIRECTORY_SEPARATOR);
define("PUBLIC_PATH", SERVER_ROOT_PATH . "public" . DIRECTORY_SEPARATOR);

define("ASSETS_PATH", PUBLIC_PATH . "assets" . DIRECTORY_SEPARATOR);
define("FRONTEND_PATH", PUBLIC_PATH . "frontend" . DIRECTORY_SEPARATOR);

define("CONTROLLERS_PATH", APP_PATH. "controllers" . DIRECTORY_SEPARATOR);
define("PAGE_CONTROLLERS_PATH", CONTROLLERS_PATH . "page-controllers" . DIRECTORY_SEPARATOR);
define("CORE_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("MODELS_PATH", APP_PATH. "models" . DIRECTORY_SEPARATOR);
define("UTILITIES_PATH", APP_PATH. "utilities" . DIRECTORY_SEPARATOR);
define("VIEWS_PATH", APP_PATH. "views" . DIRECTORY_SEPARATOR);

define("ERROR_PAGES_PATH", VIEWS_PATH . "error-pages" . DIRECTORY_SEPARATOR);
define("SKELETON_PATH", VIEWS_PATH . "skeleton" . DIRECTORY_SEPARATOR);

// Database Config //
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "map_paw_r3");
define("DB_CHARSET", "utf8mb4");

// Pages Access Config //
define("DEFAULT_PAGE", "budget-book");
define("NO_SESSION_PAGES", ["login", "signup"]); // Pages forbidden to access while being logged in
define("PUBLIC_PAGES", ["login", "signup"]); // Pages accessible without being logged in

// Environment Config //
// dev: Development environment, display error messages from the server.
// prod: Production environment, disables error messages from the server.
// Remember to change to 'prod' before hosting.
define("ENVIRONMENT", "dev");
