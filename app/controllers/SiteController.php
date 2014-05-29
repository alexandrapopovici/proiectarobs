<?php

class SiteController extends BaseController {

    public function index() {
        return View::make('index');
    }

    public function aboutUs() {
        return View::make('aboutus');
    }

}

?>
