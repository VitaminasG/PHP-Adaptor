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


    /**
     * Display raw CSV data.
     */
    public function taskOne()
    {
        $csv = new \App\Adaptors\CsvFileAdapter( new \App\Handler\Csv() );

        $csv->getContent();
    }

    /**
     * Display raw XML data.
     */
    public function taskTwo()
    {

        $xml = new \App\Adaptors\XmlFileAdapter( new \App\Handler\Xml() );

        print_r( $xml->getContent() );
    }

    /**
     * Display raw Json data.
     */
    public function taskThree()
    {
        $json = new \App\Adaptors\JsonFileAdapter( new \App\Handler\Json() );

        pp( $json->getContent() );
    }
}