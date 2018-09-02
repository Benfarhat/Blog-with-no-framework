<?php
namespace App\Controller;

use App\Model\CategorieModel;

class CategorieController extends BaseController{


    public function index(CategorieModel $categorie){
        dump($categorie->findAll());
        $this->render('base.html.twig');
    }

    public function view()
    {

    }

}