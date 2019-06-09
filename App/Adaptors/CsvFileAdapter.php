<?php


namespace App\Adaptors;


use App\Interfaces\iCsv;
use App\Interfaces\FileSystem;

class CsvFileAdapter implements FileSystem
{
    /**
     * @var iCsv
     */
    private $cvs;

    /**
     * CsvFileAdapter constructor.
     *
     * @param iCsv $csv
     */
    public function __construct(iCsv $csv)
    {
        $this->cvs = $csv;
    }

    public function getContent()
    {

        return $this->cvs->fetchContent();
    }

    public function read()
    {
        return $this->cvs->fetchToArray();
    }

    public function write()
    {
        // TODO: Implement write() method.
    }
}