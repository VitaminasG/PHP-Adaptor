<?php


namespace App;


use App\Core\Controller;

class FetchDataController extends Controller
{

    /**
     * Set a raw HTTP header.
     *
     * @var
     */
    protected $header;

    /**
     * Formatted adaptor namespace.
     *
     * @var string
     */
    protected $adaptor = '';

    /**
     * Formatted fileHandler classname.
     *
     * @var string
     */
    protected $fileHandler = '';

    public function __construct()
    {
        //
    }

    /**
     * Write data to file.
     *
     * @param string $name
     *
     * @throws \Exception
     */
    public function get($name)
    {
        $this->checkUri($name);

        $this->format($name);

        $ext = new $this->adaptor( new $this->fileHandler() );

        pp( $ext->read() );
    }

    /**
     * Format and assign.
     *
     * @param string $name
     */
    public function format(string $name)
    {
        $name = ucfirst($name);

        $this->adaptor = sprintf('\App\Adaptors\%sFileAdapter', $name);
        $this->fileHandler = sprintf('\App\Handler\%s', $name);
    }

    /**
     * Check if Uri keyword match.
     *
     * @param string $name
     *
     * @return Core\View
     * @throws \Exception
     */
    public function checkUri( string $name)
    {
        $this->header = header('Content-Type: text/html; charset=utf-8');

        $exceptArr = ['csv', 'xml', 'json'];

        if( array_search($name, $exceptArr) === false ) {

            return $this->notFound();
        }
    }
}