<?php

class FrontController {
    private $publicPages = ["login", "signup"];

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
            case "budget-book": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "budget-book/budget-book.php";
                $page_title = "Budget Book";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-category": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "budget-category/budget-category.php";
                $page_title = "Budget Category";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-account":
                $page_content = VIEWS_PATH . "budget-account/budget-account.php";
                $page_title = "Budget Account";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "record-expense": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "record-expense/record-expense.php";
                $page_title = "Record Expense";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "general-journal": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "general-journal/general-journal.php";
                $page_title = "General Journal";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "general-ledger": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "general-ledger/general-ledger.php";
                $page_title = "General Ledger";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-realization": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "budget-realization/budget-realization.php";
                $page_title = "Budget Realization";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "close-book": // Still doesn't exist yet
                $page_content = VIEWS_PATH . "close-book/close-book.php";
                $page_title = "Close Book";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            default:
                echo "<h1>404</h1>";
                break;
        }
    }
}

?>
