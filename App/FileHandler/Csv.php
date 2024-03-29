<?php


namespace App\Handler;


use App\pathFinder;
use App\Interfaces\iCsv;

/**
 *  Usage of CSV file handler class.
 *
 *  MODE:
 *
 *  'r'  - Open for reading only; pointer at the beginning of the file.
 *
 *  'r+' - Open for reading and writing;
 * pointer at the beginning of the file.
 *
 *  'w'  - Open for writing only;
 * pointer at the beginning of the file and truncate.
 *
 *  'w+' - Open for reading and writing; pointer at the beginning of the file
 * and truncate the file to zero length. If the file does not exist,
 * attempt to create it.
 *
 *  'a'  - Open for writing only; pointer at the end of the file.
 * If the file does not exist, attempt to create it. In this mode,
 * fseek() has no effect, writes are always appended.
 *
 *  'a+' - Open for reading and writing; pointer at the end of the file.
 * If the file does not exist, attempt to create it. In this mode,
 * fseek() only affects the reading position, writes are always appended.
 *
 */
class Csv implements iCsv
{
    use pathFinder;

    /**
     * Full file path.
     *
     * @var string
     */
    private $filePath;

    /**
     * File extension name.
     *
     * @var string
     */
    private $extension = '.csv';

    /**
     * Fetched data from file.
     *
     * @var array
     */
    protected $fetchData = [];

    /**
     * Default mode value - Read.
     *
     * @var array|string
     */
    protected $mode = 'r';

    /**
     * Create a CSV File Handler instance.
     *
     * @param array $mode
     * @throws \Exception if unable to get a file.
     */
    public function __construct($mode = [])
    {
        $this->filePath = $this->getFilePath($this->extension);
        $this->mode = $this->mode ?? $mode;
    }

    /**
     * Open file handler.
     *
     * @param string $path
     * @param string $mode
     *
     * @return bool|resource
     */
    protected function open( string $path, string $mode )
    {

        return fopen($path, $mode);
    }

    /**
     * Close file handler.
     *
     * @param $handler
     *
     * @return bool
     */
    protected function close($handler)
    {

        return fclose($handler);
    }

    /**
     * Fetch raw file content.
     *
     * @return false|string
     */
    public function fetchContent()
    {

        $data = file_get_contents($this->filePath);

        return $data;
    }

    /**
     * Fetch file content to Array.
     *
     * @return array
     */
    public function fetchToArray() : array
    {

        $handler = $this->open($this->filePath, $this->mode);

        while ( ($data = fgetcsv($handler, 1000, ",") ) !== false )
        {
            array_push($this->fetchData, $data);
        }

        $this->close($handler);

        return $this->getData();
    }

    /**
     * Formatting fetched data.
     *
     * @return array
     */
    protected function getData()
    {

        array_walk_recursive($this->fetchData, [$this, 'trim_value']);

        return $this->fetchData;
    }

    /**
     * Trim additional single quote.
     *
     * @param $value
     */
    protected function trim_value(&$value)
    {

        $value = trim($value, '\'');
    }

    /**
     * Write to CSV file from array.
     *
     * @param array $array
     *
     * @throws \Exception
     */
    public function writeFromArray(array $array = [])
    {

        $label = [];

        $this->setLoc('files/','save');

        $this->setFilePath($this->extension);
        $this->filePath = $this->getFilePath($this->extension);

        $fp = $this->open($this->filePath, 'w+');

        foreach ( $array[0] as $key => $value ) {

            $label[] = $key;
        }

        fputcsv($fp, $label);

        foreach ( $array as $key => $value ) {

            fputcsv($fp, $value);
        }

        $this->close($fp);
    }
}