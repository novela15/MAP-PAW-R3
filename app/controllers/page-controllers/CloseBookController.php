<?php

class CloseBookController extends FeaturePageController {
    public function post() {
        $model = new CloseBookModel(); 
        $count = $model->removeAll($_SESSION["user_id"]);
        header("location: " . DEFAULT_PAGE);
    }
}
