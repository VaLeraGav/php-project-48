<?php

namespace Differ\Formatters\Stylish;

function formatter(array $data): array
{
    $result = [];
    foreach ($data as $unit) {
        if($unit['status'] === 'not changed'){
            $result["    {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'added') {
            $result["  + {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'removed') {
            $result["  - {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'changed') {
            $result["  - {$unit['name']}"] = $unit['oldValue'];
            $result["  + {$unit['name']}"] = $unit['newValue'];
        } elseif ($unit['status'] === 'nested') {
            $result["{$unit['name']}"] = formatter($unit['child']);
        }
    }
    // переделывать 


    // return toString($result);
    return $result;
}

// function toString(array $formattedArray): string
// {
//     $result = str_replace('"', '', json_encode($formattedArray, JSON_PRETTY_PRINT));
//     $result = str_replace(",", "", $result);
//     return $result;
// }
