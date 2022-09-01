<?php

namespace Differ\Differ;

use function Differ\Parser\parser;

function genDiff($firstFilePath, $secondFilePath)
{
    $arrayFirst = parser($firstFilePath);
    $arraySecond = parser($secondFilePath);
    
    $result = diffData($arrayFirst, $arraySecond);
    return $result;
}

function diffData($arrayFirst, $arraySecond)
{
    $arrayMerge = array_merge_recursive($arrayFirst, $arraySecond);
    ksort($arrayMerge);
    $arrayResult = [];
    foreach ($arrayMerge as $key => $value) {
        if (is_bool($value)) {
            if ($value === true) {
                $value = 'true';
            } else {
                $value = 'false';
            }
        }
        if (array_key_exists($key, $arrayFirst) && array_key_exists($key, $arraySecond)) {
            if ($value[0] === $value[1]) {
                $arrayResult["    {$key}"] = $value[0];
            } else {
                $arrayResult["  - {$key}"] = $value[0];
                $arrayResult["  + {$key}"] = $value[1];
            }
        } elseif (array_key_exists($key, $arrayFirst) && !array_key_exists($key, $arraySecond)) {
            $arrayResult["  - {$key}"] = $value;
        } else {
            $arrayResult["  + {$key}"] = $value;
        }
    }
    $string = '';
    foreach ($arrayResult as $key => $value) {
        $string .= "{$key}: {$value}\n";
    }
    return "{\n{$string}}\n";
}

// $a = '../testFile/filePlain1.json';
// $b = '../testFile/filePlain2.json';
// genDiff($a, $b);
