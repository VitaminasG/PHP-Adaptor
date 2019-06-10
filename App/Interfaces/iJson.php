<?php


namespace App\Interfaces;


interface iJson
{
    public function fetchContent();

    public function writeFromArray(array $array);
}