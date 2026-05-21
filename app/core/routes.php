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

$router->get("request-password-reset", function() {
    include_once VIEWS_PATH . "auth/request-password-reset.php";
});
$router->post("request-password-reset", "AuthController::sendPasswordResetEmail");

$router->get("reset-password", "AuthController::resetPassword");
$router->post("reset-password", "AuthController::resetPassword");

$router->get("link-to-google-oauth", "AuthController::linkToGoogleOAuth");

$router->get("google-oauth", "AuthController::handleGoogleAuth");
$router->post("google-oauth", "AuthController::handleGoogleAuth");

$router->get("budget-book", "BudgetBookController::index");

$router->get("budget-category", "BudgetCategoryController::index");
$router->post("budget-category", "BudgetCategoryController::post");

$router->get("budget-account", "BudgetAccountController::index");
$router->post("budget-account", "BudgetAccountController::post");

$router->get("record-expense", "RecordExpenseController::index");
$router->post("record-expense", "RecordExpenseController::post");

$router->get("general-journal", "GeneralJournalController::index");

$router->get("general-ledger", "GeneralLedgerController::index");

$router->get("budget-realization", "BudgetRealizationController::index");

$router->post("close-book", "CloseBookController::post");

$router->get("settings", "SettingsController::index");
$router->post("settings", "SettingsController::update");

$router->get("modal", "ModalController::index");
