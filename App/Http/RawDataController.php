<?php


namespace App;

use App\Core\Controller;
use App\Core\Request;


class RawDataController extends Controller
{
    protected $header;

    public function __construct()
    {
//        $this->header = header('Content-Type: text/plain');
    }

    public function wild($name)
    {
        dd($name);
    }


    /**
     * Display raw CSV data.
     */
    public function rawOne()
    {

        $csv = new \App\Adaptors\CsvFileAdapter( new \App\Handler\Csv() );

        print( $csv->getContent() );
    }

    /**
     * Display raw XML data.
     */
    public function rawTwo()
    {

        $xml = new \App\Adaptors\XmlFileAdapter( new \App\Handler\Xml() );

        print( $xml->getContent() );
    }

    /**
     * Display raw Json data.
     */
    public function rawThree()
    {

        $json = new \App\Adaptors\JsonFileAdapter( new \App\Handler\Json() );

        print( $json->getContent() );
    }

}