<?php

class BudgetBookController extends FeaturePageController {
    public function index() {
        $budgetBookModel = new BudgetBookModel();
        $all = $budgetBookModel->getAllByUserId($_SESSION["user_id"]);
        $total_budget = 0;
        $total_used = 0;

        foreach ($all as $row) {
            $total_budget += $row['budget'];
            $total_used += $row['used'];
        }

        $this->renderView(
            "budget-book/budget-book",
            "Budget Book",
            ["budgetBook" => $all, "total_budget" => $total_budget, "total_used" => $total_used]
        );
    }
}
