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

    public function __invoke(){
        $this->index();
    }

    public function beforeRender() {
    }
    
    private function afterRender() {
    }
    
    public function render($template, $options = [])
    {
        $this->beforeRender();
        echo $this->twig->render($template, array_merge($this->env, $options));
        $this->afterRender();
    }

    private function beforeAction(){
    }
    
    private function afterAction(){
    }   

  
    public function __scall($method,$arguments) {
        if(method_exists($this, $method)) {
            $this->beforeAction();
            return call_user_func_array(array($this,$method),$arguments);
            $this>afterAction();
        }
    }

    public function __call($methodName, $arguments)
    {
        if (is_callable(
                array($this, $methodName)))
        {
            $this->beforeAction();

            call_user_func(array($this, $methodName), $arguments);

            $this>afterAction();;
        }
        else
        {
            $class = get_class($this);
            throw new \BadMethodCallException("No callable method $methodName at $class class");
        }
    }
    
    public function homepage()
    {
        return true;
    }

    public function index()
    {
        dump('Index method is not defined in your controller!');
        return true;
    }

    public function view()
    {
        dump('View method is not defined in your controller!');
        return true;
    }

    public function add()
    {
        dump('Add method is not defined in your controller!');
        return true;
    }

    public function edit()
    {
        dump('Edit method is not defined in your controller!');
        return true;
    }

    public function delete()
    {
        dump('Delete method is not defined in your controller!');
        return true;
    }

}