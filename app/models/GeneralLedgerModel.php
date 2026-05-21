<?php

class GeneralLedgerModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllByUserId(int $id): array {
        $query = "SELECT * FROM budget_category WHERE user_id = ?";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }

    public function getTableContentsByUserId(int $id): array {
        $statement = $this->db->query("
            SELECT
                be.*,
                ba.name AS name,
                be.unit_price AS unit_price,
                (be.volume * be.unit_price) AS total_price,
                0 AS debit,
                0 AS credit
            FROM budget_expenses be
            INNER JOIN budget_accounts ba ON be.budget_account_id = ba.id
            WHERE be.user_id = ?
            ORDER BY be.id DESC, be.datetime DESC", [$id]
        );
        return $statement->fetchAll() ?: [];
    }
}