<?php

// require PSR4 Class
require __DIR__ . '/PSR4.php';

// require Helper functions
require __DIR__ . '/../app/helpers/mainHelper.php';
require __DIR__ . '/../app/helpers/errorHandling.php';
require __DIR__ . '/../app/helpers/viewHelper.php';

// instantiate the loader
$loader = new \Autoload\PSR4();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('App\Core', '../app/Core');
$loader->addNamespace('App\Core', '../app/Core/Controller');
$loader->addNamespace('App\Core', '../app/Core/Router');
$loader->addNamespace('App\Core', '../app/Core/View');
$loader->addNamespace('App', '../app/');
