<?php

namespace App\Utils;



interface FileParserInterface {


    static function parse($file, $type);

    static function searchIndex($file, $index , array $array);
}


