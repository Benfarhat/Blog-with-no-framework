<?php
namespace App\Controller;

use Twig_Environment;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class BaseController {


    private $twig;
    private $env;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
        try {
            $this->env = Yaml::parseFile('../config/env.yaml');
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML string: %s', $exception->getMessage());
        }
    }

    public function render($template, $options = [])
    {
        echo $this->twig->render($template, array_merge($this->env, $options));
    }

    public function homepage()
    {
        return true;
    }

    public function index()
    {
        return true;
    }

    public function view()
    {
        return true;
    }

    public function add()
    {
        return true;
    }

    public function edit()
    {
        return true;
    }

    public function delete()
    {
        return true;
    }

}