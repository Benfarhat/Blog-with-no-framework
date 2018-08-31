<?php
use DI\ContainerBuilder;

/* Dependency Injection */
$containerBuilder = new ContainerBuilder;
$containerBuilder->useAutoWiring(true);
$containerBuilder->ignorePhpDocErrors(true);
$containerBuilder->useAnnotations(false);
//$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();
return $container;