<?php
namespace App\Controller;

use App\Model\ArticleModel;

class BlogController extends BaseController{


    public function index(ArticleModel $article){
        $this->render('base.html.twig');
    }

    public function view()
    {

    }

}