<?php

$router->get("login", function() {
    include_once VIEWS_PATH . "auth/login.php";
});
$router->post("login", "AuthController::login");
$router->post("logout", "AuthController::logout");

$router->get("signup", function() {
    include_once VIEWS_PATH . "auth/signup.php";
});
$router->post("signup", "AuthController::signup");

$router->get("budget-account", "BudgetAccountController::index");
$router->post("budget-account", "BudgetAccountController::post");

$router->get("settings", "SettingsController::index");
$router->post("settings", "SettingsController::update");

$router->get("modal", "ModalAccountController::index");
