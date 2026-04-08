<?php

class GeneralLedgerController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "general-ledger/general-ledger",
            "General Ledger"
        );
    }
}
