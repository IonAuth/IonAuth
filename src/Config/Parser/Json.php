<?php

namespace IonAuth\IonAuth\Config\Parser;

class Json implements Parser
{
    private $filepath;

    public function parse($file_path)
    {
        if (!is_file($file_path)) throw new \Exception('Config file $file_path does not exist');


    }
}
