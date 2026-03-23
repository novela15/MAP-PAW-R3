<?php

class FrontController {
    // I feel this will be a giant switch case when all features are combined, but whatever
    public function switchPage(string $page) {
        switch ($page) {
            case "login":
                $controller = new AuthController();
                $controller->login();
                break;
            case "signup":
                $controller = new AuthController();
                $controller->signup();
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
