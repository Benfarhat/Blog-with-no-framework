<?php
use Symfony\Component\Debug\Debug;
use DI\ContainerBuilder;
require __DIR__ . '/../vendor/autoload.php';

/*Symfony Debug*/
Debug::enable();

/* Dependency Injection */
$containerBuilder = new ContainerBuilder;
$containerBuilder->useAutoWiring(true);
$containerBuilder->ignorePhpDocErrors(true);
$containerBuilder->useAnnotations(false);
//$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();
return $container;