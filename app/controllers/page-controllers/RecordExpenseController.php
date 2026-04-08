<?php

class RecordExpenseController extends FeaturePageController {
    private function add() {
        $recordExpenseModel = new RecordExpenseModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $recordExpenseModel->create($_POST);
    }

    private function delete() {
        $recordExpenseModel = new RecordExpenseModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $recordExpenseModel->deleteById((int)$_POST["item_id"]);
    }

    private function edit() {
        $recordExpenseModel = new RecordExpenseModel();

        $_POST["user_id"] = $_SESSION["user_id"];
        $_POST["id"] = $_POST["item_id"];
        $recordExpenseModel->update($_POST);
    }

    public function index() {
        $recordExpenseModel = new RecordExpenseModel();

        $this->renderView(
            "record-expense/record-expense",
            "Record Expense",
            ["table" => $recordExpenseModel->getAllByUserId($_SESSION["user_id"])]
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

        header("Location: record-expense");
        exit;
    }
}
