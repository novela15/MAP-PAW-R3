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
                break;
            case "modal-expense-add":
                $budgetAccountModel = new BudgetAccountModel();
                $budgetAccounts = $budgetAccountModel->getAllNamesFromUserId($_SESSION["user_id"]);
                break;
            case "modal-expense-edit":
                $budgetAccountModel = new BudgetAccountModel();
                $budgetAccounts = $budgetAccountModel->getAllNamesFromUserId($_SESSION["user_id"]);
                break;
        }

        require_once VIEWS_PATH . "modal/" . $_GET["type"] . ".php";
    }
}
