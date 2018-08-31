<?php
namespace App\Controller;

use Twig_Environment;



class BaseController {


    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }


    public function homepage()
    {
        dump('ee');
    }

    public function render($template, $options = ['test' => 2])
    {
        $settings = require('../app/settings.php');
        $parameters = array_merge($settings, $options);

        echo $this->twig->render($template, $parameters);
    }

}