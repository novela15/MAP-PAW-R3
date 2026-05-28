<?php

class GeneralLedgerController extends FeaturePageController {
    public function index() {
        $generalLedgerModel = new GeneralLedgerModel();
        $name = $_GET["account"] ?? "[ Unknown ]";

        $userId = $_SESSION["user_id"] ?? null;
        if ($userId === null) {
            // fallback: tidak ada session user, render halaman kosong
            $this->renderView(
                "general-ledger/general-ledger",
                "General Ledger",
                ["generalLedgerModel" => [], "index" => 0]
            );
            return;
        }

        $account = $_GET["account"] ?? null;
        if ($account !== null && $account !== "") {
            $this->renderView(
                "general-ledger/general-ledger-table",
                "General Ledger",
                [
                    "generalLedgerModel" => $generalLedgerModel->getTableContentsByUserId((int)$userId, (string)$account),
                    "name" => $name
                ]
            );
        } else {
            $index = 0;

            $this->renderView(
                "general-ledger/general-ledger",
                "General Ledger",
                ["generalLedgerModel" => $generalLedgerModel->getAllByUserId((int)$userId), "index" => $index]
            );
        }
    }
}
