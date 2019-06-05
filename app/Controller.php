<?php

namespace App;

use App\Core\BaseController;
use App\Core\View;
use Exception;

class Controller extends BaseController
{

    public function __construct()
    {
        //
    }


    /**
     * Get the main Page.
     *
     * @return View
     * @throws Exception
     */
    public function index()
    {

        $slogan= 'Cover your Main page.';

        return view('index', compact('slogan'));
    }
}