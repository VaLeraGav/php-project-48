<?php

namespace Differ\Differ;

use function Differ\Formatter\formatter;
use function Differ\Parsers\parser;
use function Differ\Build\diffData;

function genDiff($firstFilePath, $secondFilePath, $format = 'stylish')
{
    $arrayFirst = parser($firstFilePath);
    $arraySecond = parser($secondFilePath);

    $result = diffData($arrayFirst, $arraySecond);

    //! нужно аккуратнее 
    // $formatResult = formatter($result);
    return $result;
}


// $a = '../testFile/filePlain1.json';
// $b = '../testFile/filePlain2.json';
// genDiff($a, $b);
