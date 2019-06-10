<?php

namespace App\Interfaces;


interface FileSystem
{
    public function getContent();

    public function read() : array;

    public function write(array $array);
}