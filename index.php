<?php
require __DIR__ . 'vendor/autoload.php';
$a = new App\Controller\HomeController();
$a->index();

require 'public' . DIRECTORY_SEPARATOR . 'index.php';