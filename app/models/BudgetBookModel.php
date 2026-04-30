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
                ba.name,
                0 AS budget,
                COALESCE(SUM(0), 0) AS used,
                (0 - COALESCE(SUM(0), 0)) AS surplus,
                CASE 
                    WHEN 0 > 0 THEN 
                        (COALESCE(SUM(0), 0) / 0) * 100
                    ELSE 0
                END AS realization,
                CASE 
                    WHEN COALESCE(SUM(0), 0) < 0 * 0.8 THEN 'Aman'
                    WHEN COALESCE(SUM(0), 0) <= 0 THEN 'Waspada'
                    ELSE 'Bahaya'
                END AS status
            FROM budget_accounts ba
            LEFT JOIN budget_expenses be ON ba.id = be.budget_account_id
            WHERE ba.user_id = ?
            GROUP BY ba.id
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }
}
