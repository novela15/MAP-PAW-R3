<?php

class GeneralLedgerController extends FeaturePageController {
    public function index() {
        $generalLedgerModel = new GeneralLedgerModel();
        $name = $_GET["account"] ?? "[ Unknown ]";

        if (isset($_GET["account"])) {
            $this->renderView(
                "general-ledger/general-ledger-table",
                "General Ledger",
                ["generalLedgerModel" => $generalLedgerModel->getTableContentsByUserId($_SESSION["user_id"]), "name" => $name]
            );
        } else {
            $index = 0;

            $this->renderView(
                "general-ledger/general-ledger",
                "General Ledger",
                ["generalLedgerModel" => $generalLedgerModel->getAllByUserId($_SESSION["user_id"]), "index" => $index]
            );
        }
    }
}
