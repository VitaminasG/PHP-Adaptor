<?php

use App\Core\BaseRouter as Router;

/**
 * ================
 * Web Router File.
 * ================
 */

Router::get('', 'TaskController@index');
Router::get('raw', 'TaskController@rawList');

Router::get('raw/{name}', 'RawDataController@raw');
