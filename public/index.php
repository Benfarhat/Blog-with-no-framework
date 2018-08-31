<?php
// Autoload
require __DIR__ . '/../vendor/autoload.php';
// Bootstrap our container
$container = require __DIR__ . '/../app/bootstrap.php';
// Enable debug
$container = require __DIR__ . '/../app/debug.php';
// Dispatcher and Router
require __DIR__ . '/../app/router.php';