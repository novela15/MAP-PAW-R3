<?php

class BudgetRealizationController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "budget-realization/budget-realization",
            "Budget Realization"
        );
    }
}
