<?php

class GeneralJournalController extends FeaturePageController {
    public function index() {
        // Gunakan data dari budget_expenses untuk mengisi tabel jurnal (debit/kredit disederhanakan = 0)
        $model = new GeneralLedgerModel();

        $journalData = $model->getJournalRowsByUserId($_SESSION["user_id"]);

        $this->renderView(
            "general-journal/general-journal",
            "General Journal",
            ["journalData" => $journalData]
        );
    }
}
