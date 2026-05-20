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
        $query = "
            SELECT
                ba.id,
                ba.name,
                ba.budget AS budget,
                COALESCE(SUM(be.volume * ba.unit_price), 0) AS total_expenses,
                CASE 
                    WHEN ba.budget > 0 THEN 
                        (COALESCE(SUM(be.volume * ba.unit_price), 0) / ba.budget) * 100
                    ELSE 0
                END AS realization,
                CASE 
                    WHEN COALESCE(SUM(be.volume * ba.unit_price), 0) < ba.budget * 0.8 THEN 'Aman'
                    WHEN COALESCE(SUM(be.volume * ba.unit_price), 0) <= ba.budget THEN 'Waspada'
                    ELSE 'Bahaya'
                END AS status
            FROM budget_accounts ba
            LEFT JOIN budget_expenses be ON ba.id = be.budget_account_id
            WHERE ba.user_id = ?
            GROUP BY ba.id, ba.name, ba.budget;
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }
}
