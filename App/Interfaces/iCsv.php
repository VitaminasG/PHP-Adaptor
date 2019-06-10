<?php


namespace App\Interfaces;


interface iCsv
{
    /**
     * Get Raw Data from file.
     *
     * @return mixed
     */
    public function fetchContent();

    /**
     * Convert raw file data to array.
     *
     * @return array
     */
    public function fetchToArray() : array;

    /**
     * Write array to file.
     *
     * @param array $array
     *
     * @return mixed
     */
    public function writeFromArray(array $array);
}