<?php

class RecordExpenseController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "record-expense/record-expense",
            "Record Expense"
        );
    }

    public function post() {

    }
}
