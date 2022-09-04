<?php

namespace Differ\Differ;

use function  Differ\Formatters\Stylish\formatter;
use function Differ\Parsers\parser;
use function Differ\Build\diffData;
// use function Differ\Build\toString;
use function Differ\TestStylish\builder;
use function Differ\Formatters\format;

function genDiff($firstFilePath, $secondFilePath, $format = 'stylish')
{
    $arrayFirst = parser($firstFilePath);
    $arraySecond = parser($secondFilePath);

    // $result = diffData($arrayFirst, $arraySecond);
    $result = builder($arrayFirst, $arraySecond);
    // print_r($result);

    $formattedTree = format($format,$result);

    // $resultFor = formatter($result);
    // print_r($formattedTree);
    // $resToString = toString($formattedTree);
    return $formattedTree;
}

