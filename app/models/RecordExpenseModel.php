<?php

class RecordExpenseModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO budget_expenses (user_id, budget_account_id, volume, description, proof) VALUES (?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $data["budget_account_id"],
                $data["volume"],
                $data["description"],
                $data["proof"] ?? null
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }

    public function deleteById(int $id): void {
        $this->db->query("DELETE FROM budget_expenses WHERE id = ?", [$id]);
    }

    public function getAllByUserId(int $id): array {
        $statement = $this->db->query("
            SELECT
                budget_expenses.*,
                budget_accounts.name AS name,
                budget_accounts.unit_price AS unit_price
            FROM budget_expenses
            INNER JOIN budget_accounts ON budget_expenses.budget_account_id = budget_accounts.id
            WHERE budget_expenses.user_id = ?", [$id]
        );
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $this->db->query(
            "UPDATE budget_expenses SET user_id = ?, budget_account_id = ?, volume = ?, description = ?, proof = ? WHERE user_id = ? AND id = ?",
            [
                $data["user_id"],
                $data["budget_account_id"],
                $data["volume"],
                $data["description"],
                $data["proof"] ?? null,
                $data["user_id"],
                $data["id"]
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }
}
