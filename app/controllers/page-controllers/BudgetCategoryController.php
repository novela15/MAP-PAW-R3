<?php

class BudgetCategoryController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "budget-category/budget-category",
            "Budget Category"
        );
    }

    public function post() {

    }
}
