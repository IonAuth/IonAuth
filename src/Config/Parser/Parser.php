<?php
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/20/15
 * Time: 3:35 AM
 */

namespace IonAuth\IonAuth\Config\Parser;


interface Parser
{
    public function parse($file_path);
}