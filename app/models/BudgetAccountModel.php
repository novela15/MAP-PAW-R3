<?php

class BudgetAccountModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): array {
        $this->db->query(
            "INSERT INTO budget_accounts (user_id, name, category_id, description, volume, unit, amount) VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $data["name"],
                $data["category_id"],
                $data["description"],
                $data["volume"],
                $data["unit"],
                $data["amount"]
            ]
        );

        return $this->getByUserId($this->db->getConnection()->lastInsertId());
    }

    public function getAllByUserId(int $id): array {
        $statement = $this->db->query("SELECT * FROM budget_accounts WHERE user_id = ?", [$id]);
        return $statement->fetchAll() ?: [];
    }
}

?>
