<?php


namespace App\Adaptors;


use App\Interfaces\FileSystem;
use App\Interfaces\iJson;

class JsonFileAdapter implements FileSystem
{
    /**
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

    public function getContent()
    {
        return $this->json->fetchContent();
    }

    public function read() : array
    {
        return $this->json->fetchContent();
    }

    public function write(array $array)
    {
        $this->json->writeFromArray($array);
    }
}