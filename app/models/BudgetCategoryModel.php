<?php

class BudgetCategoryModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO budget_category (user_id, name, description) VALUES (?, ?, ?)",
            [
                $data["user_id"],
                $data["name"],
                $data["description"]
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }

    public function deleteById(int $id): void {
        $this->db->query("DELETE FROM budget_category WHERE id = ?", [$id]);
    }

    public function getAllByUserId(int $id): array {
        $statement = $this->db->query("
            SELECT 
                budget_category.*,
                COUNT(DISTINCT budget_accounts.id) AS accounts_count,
                IFNULL(SUM(budget_expenses.volume * budget_accounts.unit_price), 0) AS total_expense
            FROM budget_category
            LEFT JOIN budget_accounts ON budget_accounts.category_id = budget_category.id
            LEFT JOIN budget_expenses ON budget_accounts.id = budget_expenses.budget_account_id
            WHERE budget_category.user_id = ?
            GROUP BY budget_category.id
        ", [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $this->db->query(
            "UPDATE budget_category SET name = ?, description = ? WHERE user_id = ? AND id = ?",
            [
                $data["name"],
                $data["description"],
                $data["user_id"],
                $data["id"],
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }
}
