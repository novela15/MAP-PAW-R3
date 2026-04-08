<?php

class GeneralJournalController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "general-journal/general-journal",
            "General Journal"
        );
    }
}
