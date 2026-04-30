<?php

class BudgetAccountModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        // Update database baru
        
        $this->db->query(
            "INSERT INTO budget_accounts (user_id, name, category_id, description, unit_price) VALUES (?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $data["name"],
                $data["category_id"],
                $data["description"],
                $data["unit_price"]
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }

    public function deleteById(int $id): void {
        $this->db->query("DELETE FROM budget_accounts WHERE id = ?", [$id]);
    }

    public function getAllByUserId(int $id): array {
        $query = "
            SELECT
                ba.*,
                bc.name AS category,
                COALESCE(SUM(be.volume), 0) AS volume,
                COALESCE(SUM(be.volume) * SUM(ba.unit_price), 0) AS total_price
            FROM budget_accounts ba
            INNER JOIN budget_category bc ON ba.category_id = bc.id
            LEFT JOIN budget_expenses be ON ba.id = be.budget_account_id
            WHERE ba.user_id = ?
            GROUP BY ba.id
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function getAllNamesFromUserId(int $id): array {
        $statement = $this->db->query("SELECT id, name FROM budget_accounts WHERE budget_accounts.user_id = ?", [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $this->db->query("UPDATE budget_accounts SET name = ?, category_id = ?, description = ?, unit_price = ?WHERE id = ?",
            [
                $data["name"],
                $data["category_id"],
                $data["description"],
                $data["unit_price"],
                $data["id"]
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }
}
