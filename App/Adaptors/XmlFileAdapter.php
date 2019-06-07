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
        header('Content-Type: text/plain');

        return $this->xml->fetchContent();
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