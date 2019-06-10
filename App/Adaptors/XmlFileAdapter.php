<?php


namespace App\Adaptors;


use App\Interfaces\FileSystem;
use App\Interfaces\iXml;

class XmlFileAdapter implements FileSystem
{
    /**
     * The instance of Xml Interface.
     *
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

    /**
     * Get Raw Data from file.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->xml->fetchContent();
    }

    /**
     * Convert raw file data to array.
     *
     * @return array
     */
    public function read() : array
    {
        return $this->xml->fetchToArray();
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
        $this->xml->writeFromArray($array);
    }
}