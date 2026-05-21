<?php

require_once __DIR__ . '/../utilities/helper_text.php';

class BudgetAccountModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        $name = sanitize_text_input(format_text_title($data["name"]));
        $description = sanitize_text_input(format_text_title($data["description"]));
        $budget = $data["volume"] * $data["unit_price"];
        $this->db->query(
            "INSERT INTO budget_accounts (user_id, name, category_id, description, volume, unit_price, budget) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $name,
                $data["category_id"],
                $description,
                $data["volume"],
                $data["unit_price"],
                $budget
            ]
        );

        return $this->getAllByUserId($data["user_id"]);
    }

    public function deleteById(int $id): void {
        $this->db->query("DELETE FROM budget_accounts WHERE id = ?", [$id]);
    }

    public function getAllByUserId(int $id): array {
        $query = "
            SELECT
                ba.id,
                ba.user_id,
                ba.category_id,
                ba.name,
                ba.description,
                ba.volume AS estimated_volume,
                ba.unit_price AS estimated_unit_price,
                ba.budget AS total_budget_plan,
                bc.name AS category,
                COALESCE(SUM(be.volume), 0) AS actual_volume_spent,
                COALESCE(SUM(be.volume * be.unit_price), 0) AS total_actual_price,
                COUNT(be.id) AS transaction_count
            FROM budget_accounts ba
            INNER JOIN budget_category bc ON ba.category_id = bc.id
            LEFT JOIN budget_expenses be ON ba.id = be.budget_account_id
            WHERE ba.user_id = ?
            GROUP BY ba.id, bc.name;
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function getAllNamesFromUserId(int $id): array {
        $statement = $this->db->query("SELECT id, name FROM budget_accounts WHERE budget_accounts.user_id = ?", [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $name = sanitize_text_input(format_text_title($data["name"]));
        $description = sanitize_text_input(format_text_title($data["description"]));
        $budget = $data["volume"] * $data["unit_price"];
        $this->db->query(
            "UPDATE budget_accounts SET name = ?, category_id = ?, description = ?, volume = ?, unit_price = ?, budget = ? WHERE id = ?",
            [
                $name,
                $data["category_id"],
                $description,
                $data["volume"],
                $data["unit_price"],
                $budget,
                $data["id"]
            ]
        );

        return $this->getAllByUserId($data["user_id"]);
    }
}