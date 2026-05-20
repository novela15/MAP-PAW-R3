<?php

class RealizationModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getRealizationByUserId($userId) {
        // Query sudah disesuaikan dengan skema database_setup.sql
        $sql = "SELECT 
                    c.id AS category_id,
                    c.name AS category_name,
                    a.id AS account_id,
                    a.name AS account_name,
                    a.amount AS budget_plan,
                    COALESCE(SUM(e.volume * a.unit_price), 0) AS actual_realization
                FROM budget_category c
                LEFT JOIN budget_accounts a ON c.id = a.category_id
                LEFT JOIN budget_expenses e ON a.id = e.budget_account_id
                WHERE c.user_id = ?
                GROUP BY c.id, a.id
                ORDER BY c.id, a.id";

        $stmt = $this->db->query($sql, [$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        $report = [];
        foreach ($rows as $row) {
            $catId = $row['category_id'];
            if (!isset($report[$catId])) {
                $report[$catId] = [
                    'name' => $row['category_name'],
                    'total_budget' => 0,
                    'total_actual' => 0,
                    'accounts' => []
                ];
            }
            
            // Masukkan data hanya jika akun anggaran tersedia
            if ($row['account_name']) {
                $report[$catId]['accounts'][] = $row;
                $report[$catId]['total_budget'] += $row['budget_plan'];
                $report[$catId]['total_actual'] += $row['actual_realization'];
            }
        }
        return $report;
    }
}