<?php
use function DI\create;

$config_container = [
    App\Model\ArticleModel::class => DI\create(App\Model\ArticleModel::class),
    App\Model\CategorieModel::class => DI\create(App\Model\CategorieModel::class),
    // Configure Twig
    Twig_Environment::class => function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../src/Views');
        return new Twig_Environment($loader);
    }
];

/*
Pour automatiquement intégrer les models selon leur nom mais ..
$path = '../src/Model';
dump($files = array_slice(scandir('../src/Model/'), 2));
$list = glob("{$path}/*.php");
foreach($list as $elt){
    $controllers[] = preg_replace( '/.php$/', '', explode('/', $elt)[3]);
}

$test = "App\\Model\\" . "ArticleModel";
$class = new \ReflectionClass($test);

//$config_container[$a::class] = DI\create(App\Model\ArticleModel::class);
$config_container[] = $class => DI\create($class);


*/




return $config_container;
