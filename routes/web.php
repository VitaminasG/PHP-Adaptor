<?php

use App\Core\BaseRouter as Router;

/**
 * ================
 * Web Router File.
 * ================
 */

Router::get('', 'TaskController@index');
Router::get('raw', 'TaskController@rawList');

Router::get('raw/1', 'TaskController@taskOne');
Router::get('raw/2', 'TaskController@taskTwo');
Router::get('raw/3', 'TaskController@taskThree');