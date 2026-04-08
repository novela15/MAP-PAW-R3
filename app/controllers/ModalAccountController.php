<?php

class ModalAccountController extends FeaturePageController {
    public function index() {
        $budgetCategoryModel = new BudgetCategoryModel();
        $budgetCategories = $budgetCategoryModel->getAllByUserId($_SESSION["user_id"]);
        require_once VIEWS_PATH . "modal/" . $_GET["type"] . ".php";
    }
}
