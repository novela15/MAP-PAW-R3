<?php

abstract class FeaturePageController {
    protected AuthHelper $authHelper;

    public function __construct() {
        $this->authHelper = new AuthHelper();
    }
}
