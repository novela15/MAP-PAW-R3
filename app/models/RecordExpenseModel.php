<?php

class RecordExpenseModel {
    private $db;
    private $textHelper;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->textHelper = new TextHelper();
    }

    public function create(array $data): array {
        $required = ["user_id", "datetime", "budget_account_id", "volume", "unit_price", "description"];
        foreach ($required as $key) {
            if (!array_key_exists($key, $data)) {
                throw new InvalidArgumentException("Missing required field: {$key}");
            }
        }

        $description = $this->textHelper->sanitizeTextInput(
            $this->textHelper->formatTextSentence((string)$data["description"])
        );

        $this->db->query(
            "INSERT INTO budget_expenses (user_id, datetime, budget_account_id, volume, unit_price, description, proof) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                (int)$data["user_id"],
                $data["datetime"], // YYYY-MM-DD
                (int)$data["budget_account_id"],
                (float)$data["volume"],
                (float)$data["unit_price"], // Satuan (Rp) dari input Belanja
                $description,
                $data["proof"] ?? null
            ]
        );

        return $this->getAllByUserId((int)$data["user_id"]);
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
            ORDER BY be.id DESC, be.datetime DESC", [$id]
        );
        return $statement->fetchAll() ?: [];
    }

    public function getById(int $id): array {
        $statement = $this->db->query("SELECT * FROM budget_expenses WHERE id = ?", [$id]);
        return $statement->fetch() ?: [];
    }

    public function update(array $data): array {
        $required = ["user_id", "id", "datetime", "budget_account_id", "volume", "unit_price", "description"];
        foreach ($required as $key) {
            if (!array_key_exists($key, $data)) {
                throw new InvalidArgumentException("Missing required field: {$key}");
            }
        }

        $description = $this->textHelper->sanitizeTextInput(
            $this->textHelper->formatTextSentence((string)$data["description"])
        );

        $this->db->query(
            "UPDATE budget_expenses SET datetime = ?, budget_account_id = ?, volume = ?, unit_price = ?, description = ?, proof = ? WHERE user_id = ? AND id = ?",
            [
                $data["datetime"],
                (int)$data["budget_account_id"],
                (float)$data["volume"],
                (float)$data["unit_price"],
                $description,
                $data["proof"] ?? null,
                (int)$data["user_id"],
                (int)$data["id"]
            ]
        );

        return $this->getAllByUserId((int)$data["user_id"]);
    }
}
