<?php

class BudgetCategoryController extends FeaturePageController {
    private function add() {
        $budgetCategoryModel = new BudgetCategoryModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $budgetCategoryModel->create($_POST);
    }

    private function delete() {
        $budgetCategoryModel = new BudgetCategoryModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $budgetCategoryModel->deleteById((int)$_POST["item_id"]);
    }

    private function edit() {
        $budgetCategoryModel = new BudgetCategoryModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $_POST["id"] = $_POST["item_id"];
        $budgetCategoryModel->update($_POST);
    }

    public function index() {
        $budgetCategoryModel = new BudgetCategoryModel();

        $this->renderView(
            "budget-category/budget-category",
            "Budget Category",
            ["table" => $budgetCategoryModel->getAllByUserId($_SESSION["user_id"])]
        );
    }

    public function post() {
        if (!isset($_POST) || !isset($_POST["type"])) { return; }

        switch ($_POST["type"]) {
            case "add":
                $this->add();
                break;
            case "delete":
                $this->delete();
                break;
            case "edit":
                $this->edit();
                break;
        }

        header("Location: budget-category");
        exit;
    }
}
