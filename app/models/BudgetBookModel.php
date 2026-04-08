<?php

class BudgetBookModel {
    private $db;
    private BudgetAccountModel $budgetAccountModel;
    private BudgetCategoryModel $budgetCategoryModel;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->budgetAccountModel = new BudgetAccountModel();
        $this->budgetCategoryModel = new BudgetCategoryModel();
    }

    public function getAllByUserId(int $id): array {
        // budget, surplus, realization, and status is currently a dummy data
        $query = "
            SELECT
                budget_accounts.name AS name,
                COALESCE(SUM(budget_expenses.amount), 0) AS amount,
                0 AS budget,
                0 AS surplus,
                0 AS realization,
                'Aman' AS status
            FROM budget_accounts
            LEFT JOIN budget_expenses ON budget_accounts.id = budget_expenses.budget_account_id
            WHERE budget_accounts.user_id = ?
            GROUP BY budget_accounts.id
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }
}
