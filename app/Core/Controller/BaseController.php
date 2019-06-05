<?php

namespace App\Core;

use Exception;

class BaseController
{

    /**
     * Get 404 - Not Found Page.
     *
     * @return View
     * @throws Exception
     */
    public function notFound()
    {

        return error('404', [], '404');
    }

}