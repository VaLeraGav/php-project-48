<?php

namespace Differ\Differ;

use function Differ\Parsers\parser;
use function Differ\TestStylish\builder;
use function Differ\Formatters\format;

function genDiff($firstFilePath, $secondFilePath, $format = 'stylish')
{
    $arrayFirst = parser($firstFilePath);
    $arraySecond = parser($secondFilePath);

    $result = builder($arrayFirst, $arraySecond);

    $formattedTree = format($format,$result);

    return $formattedTree;
}

