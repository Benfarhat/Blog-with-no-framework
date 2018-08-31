<?php
namespace App\Controller;

class HomeController extends BaseController{

    public function homepage(){
        $this->render('base.html.twig');
    }


}