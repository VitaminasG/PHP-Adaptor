<?php

namespace App\Interfaces;


interface FileSystem
{

    public function getContent();

    public function read();

    public function write();

}