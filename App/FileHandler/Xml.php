<?php


namespace App\Handler;


use App\Interfaces\iXml;
use App\pathFinder;

/**
 * Usage of XML file handler class.
 *
 */
class Xml implements iXml
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
    private $extension = '.xml';

    /**
     * Fetched data from file.
     *
     * @var array
     */
    protected $fetchData = [];

    /**
     * Create a XML File Handler instance.
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

    /**
     * Fetch file content to Array.
     *
     * @return array
     * @throws \Exception
     */
    public function fetchToArray(): array
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

    /**
     * Write to XML file from array.
     *
     * @param array $array
     *
     * @throws \Exception
     */
    public function writeFromArray(array $array)
    {

        $this->setLoc('files/','save');

        $this->setFilePath($this->extension);
        $this->filePath = $this->getFilePath($this->extension);

        $xml = new \DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;

        $items = $xml->createElement('items');
        $xml->appendChild($items);

        foreach ( $array as $key => $value ) {

            $item = $xml->createElement('item');
            $items->appendChild($item);

            foreach ( $value as $a => $b){

            $elem = $xml->createElement($a, $b);
            $item->appendChild($elem);

            }
        }

        $xml->save($this->filePath);

    }

}