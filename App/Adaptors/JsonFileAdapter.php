<?php


namespace App\Adaptors;


use App\Interfaces\FileSystem;
use App\Interfaces\iJson;

class JsonFileAdapter implements FileSystem
{
    /**
     * The instance of Json Interface.
     *
     * @var iJson
     */
    private $json;

    /**
     * JsonFileAdapter constructor.
     *
     * @param iJson $json
     */
    public function __construct(iJson $json)
    {
        $this->json = $json;
    }

    /**
     * Get Raw Data from file.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->json->fetchContent();
    }

    /**
     * Convert raw file data to array.
     *
     * @return array
     */
    public function read() : array
    {
        return $this->json->fetchToArray();
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
        $this->json->writeFromArray($array);
    }
}