<?php

class FrontController {
    private $publicPages = ["login", "signup"];

    // I feel this will be a giant switch case when all features are combined, but whatever
    public function switchPage(string $page) {
        if (!isset($_SESSION["user_id"]) && !in_array($page, $this->publicPages)) {
            header("Location: login"); 
            exit();
        }

        switch ($page) {
            case "login":
                $controller = new AuthController();
                $controller->login();
                break;
            case "signup":
                $controller = new AuthController();
                $controller->signup();
                break;
            case "logout":
                $controller = new AuthController();
                $controller->logout();
                break;
            case "budget-account":
                include_once VIEWS_PATH . "budget-account/budget-account.php";
                break;
            default:
                echo "<h1>404</h1>";
                break;
        }
    }
}

?>
