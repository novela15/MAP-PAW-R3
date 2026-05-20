<?php

class BudgetRealizationController extends FeaturePageController {
    public function index() {
        // Hapus $this->db di dalam kurung, biarkan kosong
        $model = new RealizationModel(); 
        $realizationData = $model->getRealizationByUserId($_SESSION["user_id"]);
        
        $this->renderView(
            "budget-realization/budget-realization",
            "Budget Realization",
            ['realizationData' => $realizationData]
        );
    }
}