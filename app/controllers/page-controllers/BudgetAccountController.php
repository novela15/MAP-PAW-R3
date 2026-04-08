<?php

class BudgetAccountController extends FeaturePageController {
    private function add() {
        $budgetAccountModel = new BudgetAccountModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $budgetAccountModel->create($_POST);
    }

    private function delete() {
        $budgetAccountModel = new BudgetAccountModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $budgetAccountModel->deleteById((int)$_POST["item_id"]);
    }

    private function edit() {
        $budgetAccountModel = new BudgetAccountModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $_POST["id"] = $_POST["item_id"];
        $budgetAccountModel->update($_POST);
    }

    public function index() {
        $model = new BudgetAccountModel();
        $budgetAccountTables = $model->getAllByUserId($_SESSION["user_id"]);

        $this->renderView(
            "budget-account/budget-account",
            "Budget Account",
            ['budgetAccountTables' => $budgetAccountTables]
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

        header("Location: budget-account");
        exit;
    }
}
