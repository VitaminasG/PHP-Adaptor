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
        // TODO: Implement getContent() method.
    }

    public function read()
    {
        // TODO: Implement read() method.
    }

    public function write()
    {
        // TODO: Implement write() method.
    }
}