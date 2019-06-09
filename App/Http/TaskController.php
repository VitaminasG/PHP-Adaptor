<?php

namespace App;

use App\Core\Controller;
use App\Core\View;
use Exception;

class TaskController extends Controller
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

        $slogan= 'PHP Adaptor Design Pattern.';

        return view('index', compact('slogan'));
    }

    /**
     * Get the main Page.
     *
     * @return View
     * @throws Exception
     */
    public function rawList()
    {
        $slogan= 'Raw Data';

        return view('raw', compact('slogan'));
    }
}