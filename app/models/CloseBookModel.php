<?php

class CloseBookModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function removeAll(): int {
        $query = "DELETE FROM budget_category;";

        $statement = $this->db->query($query);
        return $statement->rowCount() > 0;
    }
}