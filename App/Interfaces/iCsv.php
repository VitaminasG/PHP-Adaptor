<?php


namespace App\Interfaces;


interface iCsv
{
    public function fetchContent();

    public function fetchToArray() : array;

    public function writeFromArray(array $array);
}