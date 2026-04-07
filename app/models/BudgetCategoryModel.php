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
        $statement = $this->db->query("SELECT * FROM budget_category WHERE budget_category.user_id = ?", [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function update(array $data): array {
        $this->db->query(
            "UPDATE budget_category SET name = ?, description = ? WHERE user_id = ? AND id = ?",
            [
                $data["name"],
                $data["user_id"],
                $data["description"],
                $data["id"],
            ]
        );

        return $this->getAllByUserId($this->db->getConnection()->lastInsertId());
    }
}
