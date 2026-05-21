<?php

require_once 'helper_text.php';

class RecordExpenseModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        $description = sanitize_text_input(format_text_title($data["description"]));
        $this->db->query(
            "INSERT INTO budget_expenses (user_id, datetime, budget_account_id, volume, unit_price, description, proof) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $data["datetime"], // Diambil dari input type="date" (YYYY-MM-DD)
                $data["budget_account_id"],
                $data["volume"],
                $data["unit_price"], // Satuan (Rp) dari input Belanja
                $description,
                $data["proof"] ?? null
            ]
        );

        return $this->getAllByUserId($data["user_id"]);
    }

    public function deleteById(int $id): void {
        $this->db->query("DELETE FROM budget_expenses WHERE id = ?", [$id]);
    }

    public function getAllByUserId(int $id): array {
        $statement = $this->db->query("
            SELECT
                be.*,
                ba.name AS name,
                be.unit_price AS unit_price,
                (be.volume * be.unit_price) AS total_price
            FROM budget_expenses be
            INNER JOIN budget_accounts ba ON be.budget_account_id = ba.id
            WHERE be.user_id = ?
            ORDER BY be.datetime DESC", [$id]
        );
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $description = sanitize_text_input(format_text_title($data["description"]));
        $this->db->query(
            "UPDATE budget_expenses SET datetime = ?, budget_account_id = ?, volume = ?, unit_price = ?, description = ?, proof = ? WHERE user_id = ? AND id = ?",
            [
                $data["datetime"],
                $data["budget_account_id"],
                $data["volume"],
                $data["unit_price"],
                $description,
                $data["proof"] ?? null,
                $data["user_id"],
                $data["id"]
            ]
        );

        return $this->getAllByUserId($data["user_id"]);
    }
}