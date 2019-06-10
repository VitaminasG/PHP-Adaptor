<?php

namespace App\Interfaces;


interface FileSystem
{
    /**
     * Get Raw Data from file.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Convert raw file data to array.
     *
     * @return array
     */
    public function read() : array;

    /**
     * Write array to file.
     *
     * @param array $array
     *
     * @return mixed
     */
    public function write(array $array);
}