<?php
// Autoload
require __DIR__ . '/../vendor/autoload.php';
// Settings and constant
require __DIR__ . '/../app/settings.php';
// Bootstrap our container
$container = require __DIR__ . '/../app/bootstrap.php';
// Enable debug
require __DIR__ . '/../app/debug.php';
// Router
require __DIR__ . '/../app/router.php';
// Dispatcher
require __DIR__ . '/../app/dispatcher.php';