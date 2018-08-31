<?php
return [
    // Configure Twig
    Twig_Environment::class => function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../src/Views');
        return new Twig_Environment($loader);
    },
];