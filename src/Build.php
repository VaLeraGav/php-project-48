<?php

namespace Differ\Build;

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
    return toString($arrayResult);
}

// function toString(array $array): string
// {
//     $string = '';
//     foreach ($array as $key => $value) {
//         $string .= "{$key}: {$value}\n";
//     }
//     return "{\n{$string}}\n";
// }


function toString(array $formattedArray): string
{
    $result = str_replace('"', '', json_encode($formattedArray, JSON_PRETTY_PRINT));
    $result = str_replace(",", "", $result);
    return $result;
}
