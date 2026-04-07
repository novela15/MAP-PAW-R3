<?php

class FrontController {
    private AuthHelper $authHelper;

    public function __construct() {
        $this->authHelper = new AuthHelper();
    }

    public function render(string $page) {
        if (!$this->authHelper->isLoggedIn() && !in_array($page, PUBLIC_PAGES)) {
            header("Location: login"); 
            exit();
        }

        if ($this->authHelper->isLoggedIn() && in_array($page, NO_SESSION_PAGES)) {
            header("Location: " . DEFAULT_PAGE); 
            exit();
        }

        $messages = $this->authHelper->getAllMessages();

        switch ($page) {
            case "login":
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $controller = new AuthController($this->authHelper);
                    $controller->login();
                } else {
                    include_once VIEWS_PATH . "auth/login.php";
                }
                break;
            case "signup":
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $controller = new AuthController($this->authHelper);
                    $controller->signup();
                } else {
                    include_once VIEWS_PATH . "auth/signup.php";
                }
                break;
            case "logout":
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $controller = new AuthController($this->authHelper);
                    $controller->logout();
                }
                break;
            case "budget-book":
                $pageContent = VIEWS_PATH . "budget-book/budget-book.php";
                $pageTitle = "Budget Book";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-category": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "budget-category/budget-category.php";
                $pageTitle = "Budget Category";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-account":
                $pageContent = VIEWS_PATH . "budget-account/budget-account.php";
                $pageTitle = "Budget Account";

                $budgetAccountModel = new BudgetAccountModel();

                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["action"]) && isset($_GET["item_id"])) {
                    $_POST["user_id"] = $_SESSION["user_id"];

                    switch ($_GET["action"]) {
                        case "add":
                            $budgetAccountModel->create($_POST);
                            break;
                        case "delete":
                            $budgetAccountModel->deleteById((int)$_GET["item_id"]);
                            break;
                        case "edit":
                            $_POST["id"] = $_GET["item_id"];
                            $budgetAccountModel->update($_POST);
                            break;
                    }
                    header("Location: budget-account");
                    exit();
                } else {
                    $budgetAccountTables = $budgetAccountModel->getAllByUserId($_SESSION["user_id"]);
                }

                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "record-expense": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "record-expense/record-expense.php";
                $pageTitle = "Record Expense";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "general-journal": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "general-journal/general-journal.php";
                $pageTitle = "General Journal";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "general-ledger": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "general-ledger/general-ledger.php";
                $pageTitle = "General Ledger";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "budget-realization": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "budget-realization/budget-realization.php";
                $pageTitle = "Budget Realization";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "close-book": // Still doesn't exist yet
                $pageContent = VIEWS_PATH . "close-book/close-book.php";
                $pageTitle = "Close Book";
                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "settings":
                $pageContent = VIEWS_PATH . "settings/settings.php";
                $pageTitle = "Settings";

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $controller = new AuthController($this->authHelper);
                    $controller->update();
                } else {
                    $model = new UserModel();
                    $userData = $model->getUserById($_SESSION["user_id"]);
                }

                require_once SKELETON_PATH . "skeleton.php";
                break;
            case "modal": // GET only "page" for fetching modal elements
                if ($_SERVER["REQUEST_METHOD"] === "GET") {
                    $budgetCategoryModel = new BudgetCategoryModel();
                    $budgetCategories = $budgetCategoryModel->getAllByUserId($_SESSION["user_id"]);
                    require_once VIEWS_PATH . "modal/" . $_GET["type"] . ".php";
                }
                break;
            case "error-test": // Debug page for developers
                if (ENVIRONMENT === "dev") {
                    throw new Exception("Error page.");
                }
                break;
            default:
                throw new PageNotFoundException();
                break;
        }
    }
}
