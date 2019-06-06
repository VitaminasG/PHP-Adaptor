<?php

use App\Core\BaseRouter as Router;

/**
 * ================
 * Web Router File.
 * ================
 */

Router::get('', 'TaskController@index');