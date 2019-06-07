<?php


namespace App\Handler;


use App\Interfaces\iXml;

/**
 * Usage of XML file handler class.
 *
 * print_r($xml->fetchContent());
 * die();
 *
 */

class Xml implements iXml
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
     * Create a XML File Handler instance.
     *
     */
    public function __construct()
    {
        $this->filePath = basePath() . "files/data.xml";
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
     * @throws \Exception
     */
    public function fetchToArray()
    {
        if( !file_exists($this->filePath) ) {

            throw new \Exception('File don\'t exist!');
        }

        $file = file_get_contents($this->filePath);
        $xml = simplexml_load_string($file);

        return $this->getData($xml);
    }

    /**
     * Formatting fetched data.
     *
     * @param \SimpleXMLElement $data
     *
     * @return array
     */
    protected function getData( \SimpleXMLElement $data )
    {
        $final = [];

        $enc = json_encode($data);
        $dec = json_decode($enc, true);

        foreach ($dec as $item) {
            $final = $item;
        }

        return $final;
    }

    public function write()
    {
        // TODO: Implement write() method.
    }

}