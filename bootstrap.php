<?php

use App\Core\Container as App;

/**
 * ===========================
 * Bootstrap your Application.
 * ===========================
 */

$app = new App();

//$csv = new \App\Adaptors\CsvFileAdapter(new \App\Handler\Csv());
//
//$csv->getContent();

$app->direct();