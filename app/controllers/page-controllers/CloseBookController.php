<?php

class CloseBookController extends FeaturePageController {
    public function index() {
        $this->renderView(
            "close-book/close-book",
            "Close Book"
        );
    }
}
