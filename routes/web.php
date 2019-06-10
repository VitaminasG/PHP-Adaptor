<?php

use App\Core\BaseRouter as Router;

/**
 * ================
 * Web Router File.
 * ================
 */

Router::get('', 'TaskController@index');
Router::get('raw', 'TaskController@rawList');
Router::get('write', 'TaskController@writeList');
Router::get('get', 'TaskController@getList');

Router::get('raw/{name}', 'RawDataController@raw');
Router::get('write/{name}', 'WriteDataController@write');
