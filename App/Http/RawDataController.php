<?php


namespace App;

use App\Core\Controller;

class RawDataController extends Controller
{
    protected $header;

    public function __construct()
    {
        //
    }

    public function raw( string $name )
    {
        $exceptArr = ['csv', 'xml', 'json'];

        if( array_search($name, $exceptArr) === false ) {

            return $this->notFound();
        }

        $this->header = header('Content-Type: text/plain');

        $name = ucfirst($name);

        $adaptor = sprintf('\App\Adaptors\%sFileAdapter', $name);
        $fileHandler = sprintf('\App\Handler\%s', $name);

        $ext = new $adaptor( new $fileHandler() );

        print( $ext->getContent() );
    }
}