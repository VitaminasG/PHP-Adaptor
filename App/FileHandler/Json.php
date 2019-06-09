<?php


namespace App\Handler;


use App\Interfaces\iJson;
use App\pathFinder;

/**
 * Usage of JSON file handler class.
 *
 */
class Json implements iJson
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
    private $extension = '.json';

    /**
     * Fetched data from file.
     *
     * @var array
     */
    protected $fetchData = [];

    /**
     * Create a JSON File Handler instance.
     *
     * @throws \Exception if unable to get a file.
     */
    public function __construct()
    {
        $this->filePath = $this->getFilePath($this->extension);
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

    public function write()
    {
        // TODO: Implement write() method.
    }
}