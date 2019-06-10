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
     * Get the main page.
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
     * Get the raw data page.
     *
     * @return View
     * @throws Exception
     */
    public function rawList()
    {
        $slogan= 'Get Raw Data';

        return view('raw', compact('slogan'));
    }

    /**
     * Get the write data page.
     *
     * @return View
     * @throws Exception
     */
    public function writeList()
    {
        $slogan= 'Write Data';

        return view('write', compact('slogan'));
    }
}