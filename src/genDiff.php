<?php

namespace Differ\Differ;

function readFile($filePath)
{
    if (!file_exists($filePath)) {
        throw new \Exception("The file {$filePath} does not exists.\n");
    }
    return file_get_contents($filePath);
}

function genDiff($firstFilePath, $secondFilePath)
{
    $arrayFirst = json_decode(readFile($firstFilePath), true);
    $arraySecond = json_decode(readFile($secondFilePath), true);

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
        // if (is_array($value) && $value[0] === $value[1]) {
        //     $arrayResult["    {$key}"] = $value[0];
        // } elseif (is_array($value) && $value[0] !== $value[1]) {
        //     $arrayResult["  - {$key}"] = $value[0];
        //     $arrayResult["  + {$key}"] = $value[1];
        // } elseif (!array_key_exists($key, $arraySecond)) {
        //     $arrayResult["  - {$key}"] = $value;
        // } else {
        //     $arrayResult["  + {$key}"] = $value;
        // }
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

    // $result = str_replace('"', '', json_encode($arrayResult));
    // $result = str_replace('{', "{\n  ", $result);
    // $result = str_replace('}', "\n}", $result);
    // $result = str_replace(",", "\n  ", $result);
    // $result = str_replace(":", ": ", $result);

    $string = '';
    foreach ($arrayResult as $key => $value) {
        $string .= "{$key}: {$value}\n";
    }
    return "{\n{$string}}";
}


// $a = '../testFile/filePlain1.json';
// $b = '../testFile/filePlain2.json';
// genDiff($a, $b);
