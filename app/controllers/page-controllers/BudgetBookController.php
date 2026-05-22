<?php

class BudgetBookController extends FeaturePageController {
    public function index() {
        $budgetBookModel = new BudgetBookModel();
        $all = $budgetBookModel->getAllByUserId($_SESSION["user_id"]);
        $history = $budgetBookModel->getMonthlySpending($_SESSION["user_id"]);
        $total_budget = 0;
        $total_expenses = 0;

        foreach ($all as $row) {
            $total_budget += $row["budget"];
            $total_expenses += $row["total_expenses"];
        }

        $this->renderView(
            "budget-book/budget-book",
            "Budget Book",
            [
                "budgetBookModel" => $all,
                "total_budget" => $total_budget,
                "total_expenses" => $total_expenses,
                "history" => $history
            ]
        );
    }
}
