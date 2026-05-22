<?php

class ModalController extends FeaturePageController {
    public function index() {
        switch ($_GET["type"]) {
            case "modal-account-add":
                $budgetCategoryModel = new BudgetCategoryModel();
                $budgetCategories = $budgetCategoryModel->getAllByUserId($_SESSION["user_id"]);
                break;

            case "modal-account-edit":
                $budgetCategoryModel = new BudgetCategoryModel();
                $budgetCategories = $budgetCategoryModel->getAllByUserId($_SESSION["user_id"]);

                $budgetAccountModel = new BudgetAccountModel();
                $itemId = isset($_GET["item_id"]) ? (int)$_GET["item_id"] : 0;
                $accountData = $budgetAccountModel->getById($itemId);
                break;

            case "modal-category-edit":
                $budgetCategoryModel = new BudgetCategoryModel();
                $itemId = isset($_GET["item_id"]) ? (int)$_GET["item_id"] : 0;
                $categoryData = $budgetCategoryModel->getById($itemId);
                break;

            case "modal-expense-add":
                $budgetAccountModel = new BudgetAccountModel();
                $budgetAccounts = $budgetAccountModel->getAllNamesFromUserId($_SESSION["user_id"]);
                break;

            case "modal-expense-edit":
                $budgetAccountModel = new BudgetAccountModel();
                $budgetAccounts = $budgetAccountModel->getAllNamesFromUserId($_SESSION["user_id"]);

                $recordExpenseModel = new RecordExpenseModel();
                $itemId = isset($_GET["item_id"]) ? (int)$_GET["item_id"] : 0;
                $expenseData = $recordExpenseModel->getById($itemId);
                break;
        }

        require_once VIEWS_PATH . "modal/" . $_GET["type"] . ".php";
    }
}
