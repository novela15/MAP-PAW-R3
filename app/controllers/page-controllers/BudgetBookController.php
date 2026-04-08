<?php

class BudgetBookController extends FeaturePageController {
    public function index() {
        $budgetBookModel = new BudgetBookModel();
        $all = $budgetBookModel->getAllByUserId($_SESSION["user_id"]);
        $total_budget = 0;

        foreach ($all as $row) {
            $total_budget = $total_budget + $row["amount"];
        }

        $this->renderView(
            "budget-book/budget-book",
            "Budget Book",
            ["budgetBook" => $all, "total_budget" => $total_budget]
        );
    }
}
