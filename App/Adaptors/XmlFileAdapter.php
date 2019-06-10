<?php


namespace App\Adaptors;


use App\Interfaces\FileSystem;
use App\Interfaces\iXml;

class XmlFileAdapter implements FileSystem
{
    /**
     * @var iXml
     */
    private $xml;

    /**
     * XmlFileAdapter constructor.
     *
     * @param iXml $xml
     */
    public function __construct(iXml $xml)
    {
        $this->xml = $xml;
    }

    public function getContent()
    {

        return $this->xml->fetchContent();
    }

    public function read() : array
    {
        return $this->xml->fetchToArray();
    }

    public function write(array $array)
    {
        $this->xml->writeFromArray($array);
    }
}