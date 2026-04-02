<?php

class BudgetAccountModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    private function hitungAnggaran($amount, $pengeluaran): array {
        $sisa = $amount - $pengeluaran;

        $realisasi = ($amount > 0)
            ? ($pengeluaran / $amount) * 100
            : 0;

        if ($realisasi < 80) {
            $status = "Aman";
        } elseif ($realisasi <= 100) {
            $status = "Waspada";
        } else {
            $status = "Bahaya";
        }

        return [
            "sisa" => $sisa,
            "realisasi" => $realisasi,
            "status" => $status
        ];
    }

    public function updatePengeluaran(int $id, float $tambahan): bool {
        // Ambil data lama
        $statement = $this->db->query(
            "SELECT amount, pengeluaran FROM budget_accounts WHERE id = ?",
            [$id]
        );

        $data = $statement->fetch();
        if (!$data) return false;

        $pengeluaranBaru = $data["pengeluaran"] + $tambahan;

        $hasil = $this->hitungAnggaran($data["amount"], $pengeluaranBaru);

        // Update
        $this->db->query("
            UPDATE budget_accounts SET 
                pengeluaran = ?, 
                sisa = ?, 
                realisasi = ?, 
                status = ?
            WHERE id = ?
            ",
            [
                $pengeluaranBaru,
                $hasil["sisa"],
                $hasil["realisasi"],
                $hasil["status"],
                $id
            ]
        );

        return true;
    }

    public function create(array $data): array {
        // $pengeluaran = $data["pengeluaran"] ?? 0;

        // $hasil = $this->hitungAnggaran($data["amount"], $pengeluaran);
        
        $this->db->query(
            "INSERT INTO budget_accounts (user_id, name, category_id, description, unit) VALUES (?, ?, ?, ?, ?)",
            [
                $data["user_id"],
                $data["name"],
                $data["category_id"],
                $data["description"],
                $data["unit"],
                // $pengeluaran,
                // $hasil["sisa"],
                // $hasil["realisasi"],
                // $hasil["status"]
            ]
        );

        return $this->getByUserId($this->db->getConnection()->lastInsertId());
    }

    public function getAllByUserId(int $id): array {
        $query = "
            SELECT
                budget_accounts.*,
                budget_category.name AS category,
                COALESCE(SUM(budget_expenses.amount), 0) AS amount,
                COALESCE(SUM(budget_expenses.volume), 0) AS volume
            FROM budget_accounts
            INNER JOIN budget_category ON budget_accounts.category_id = budget_category.id
            LEFT JOIN budget_expenses ON budget_accounts.id = budget_expenses.budget_account_id
            WHERE budget_accounts.user_id = ?
            GROUP BY budget_accounts.id
        ";

        $statement = $this->db->query($query, [$id]);
        return $statement->fetchAll() ?: [];
    }
}

?>
