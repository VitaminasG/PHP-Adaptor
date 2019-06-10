<?php


namespace App\Adaptors;


use App\Interfaces\iCsv;
use App\Interfaces\FileSystem;

class CsvFileAdapter implements FileSystem
{
    /**
     * The instance of Csv Interface.
     *
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

    /**
     * Get Raw Data from file.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->cvs->fetchContent();
    }

    /**
     * Convert raw file data to array.
     *
     * @return array
     */
    public function read() : array
    {
        return $this->cvs->fetchToArray();
    }

    /**
     * Write array to file.
     *
     * @param array $array
     *
     * @return mixed
     */
    public function write(array $array)
    {
        $this->cvs->writeFromArray($array);
    }
}