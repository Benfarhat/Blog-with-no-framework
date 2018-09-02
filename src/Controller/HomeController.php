<?php
namespace App\Controller;


class HomeController extends BaseController{

    public function beforeRender() {
    }
    
    public function homepage(){
        $this->render('base.html.twig');
    }


}