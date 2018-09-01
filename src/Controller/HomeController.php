<?php
namespace App\Controller;

class HomeController extends BaseController{

    public function beforeRender() {
        dump('Another before render');
    }
    
    public function homepage(){
        $this->render('base.html.twig');
    }


}