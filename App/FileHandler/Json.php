<?php


namespace App\Handler;


use App\Interfaces\iJson;

/**
 * Usage of JSON file handler class.
 *
 */
class Json implements iJson
{

    /**
     * Full file path.
     *
     * @var string
     */
    protected $filePath;

    /**
     * Fetched data from file.
     *
     * @var array
     */
    protected $fetchData = [];

    /**
     * Create a JSON File Handler instance.
     *
     */
    public function __construct()
    {
        $this->filePath = basePath() . "files/data.json";
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

}