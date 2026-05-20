<?php

class RealizationModel {
    private $db;

    public function __construct() {
        // Ini kuncinya! Mengambil koneksi database sesuai standar aplikasimu
        $this->db = Database::getInstance();
    }

    public function getRealizationByUserId($userId) {
        $sql = "SELECT 
                    c.id AS category_id,
                    c.name AS category_name,
                    a.name AS account_name,
                    a.amount AS budget_plan,
                    COALESCE(SUM(e.volume * a.unit_price), 0) AS actual_realization
                FROM budget_category c
                LEFT JOIN budget_accounts a ON c.id = a.category_id
                LEFT JOIN budget_expenses e ON a.id = e.budget_account_id
                WHERE c.user_id = ?
                GROUP BY c.id, a.id
                ORDER BY c.id, a.id";

        // Menggunakan metode query bawaan dari class Database milikmu
        $stmt = $this->db->query($sql, [$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        // Mengelompokkan data berdasarkan kategori
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
            
            if ($row['account_name']) {
                $report[$catId]['accounts'][] = $row;
                $report[$catId]['total_budget'] += $row['budget_plan'];
                $report[$catId]['total_actual'] += $row['actual_realization'];
            }
        }
        return $report;
    }
}