<?php

// require PSR4 Class
require __DIR__ . '/PSR4.php';

// require Helper functions
require __DIR__ . '/../App/helpers/mainHelper.php';
require __DIR__ . '/../App/helpers/errorHandling.php';
require __DIR__ . '/../App/helpers/viewHelper.php';

// instantiate the loader
$loader = new \Autoload\PSR4();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('App', '../App/');
$loader->addNamespace('App', '../App/Http');
$loader->addNamespace('App\Core', '../App/Core');
$loader->addNamespace('App\Core', '../App/Core/Controller');
$loader->addNamespace('App\Core', '../App/Core/Router');
$loader->addNamespace('App\Core', '../App/Core/View');
$loader->addNamespace('App\Interfaces', '../App/Interface');
$loader->addNamespace('App\Adaptors', '../App/Adaptors');
$loader->addNamespace('App\Handler', '../App/FileHandler');
