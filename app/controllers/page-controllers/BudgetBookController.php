<?php

class BudgetBookController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "budget-book/budget-book",
            "Budget Book"
        );
    }
}
