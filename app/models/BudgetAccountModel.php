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
    $this->db->query(
        "UPDATE budget_accounts SET 
            pengeluaran = ?, 
            sisa = ?, 
            realisasi = ?, 
            status = ?
        WHERE id = ?",
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
        $pengeluaran = $data["pengeluaran"] ?? 0;

        $hasil = $this->hitungAnggaran($data["amount"], $pengeluaran);
        
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
                $pengeluaran,
                $hasil["sisa"],
                $hasil["realisasi"],
                $hasil["status"]
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
