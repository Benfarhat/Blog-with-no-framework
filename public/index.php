<?php
// Autoload
require __DIR__ . '/../vendor/autoload.php';
// Settings and constant
require __DIR__ . '/../app/settings.php';
// Bootstrap our container
// Le container d'injection de dépendance sera utilisé dans le dispatcher
$container = require __DIR__ . '/../app/bootstrap.php';
// Enable debug
require __DIR__ . '/../app/debug.php';
// Dispatcher
require __DIR__ . '/../app/dispatcher.php';