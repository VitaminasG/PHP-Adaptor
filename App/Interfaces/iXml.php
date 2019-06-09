<?php


namespace App\Interfaces;


interface iXml
{
    public function fetchContent();

    public function fetchToArray(): array;

    public function writeFromArray(array $array);
}