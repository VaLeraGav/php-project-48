<?php

namespace Differ\Formatters\Stylish;

function formatter(array $data): array
{
    $result = [];
    foreach ($data as $unit) {
        if ($unit['status'] === 'not changed') {
            $result["    {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'added') {
            $result["  + {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'removed') {
            $result["  - {$unit['name']}"] = $unit['value'];
        } elseif ($unit['status'] === 'changed') {
            $result["  - {$unit['name']}"] = $unit['oldValue'];
            $result["  + {$unit['name']}"] = $unit['newValue'];
        } elseif ($unit['status'] === 'nested') {
            $result["    {$unit['name']}"] = formatter($unit['child']);
        }
    }
    // переделывать 
    // $array = array_map(function ($unit) {
    //     switch ($unit) {
    //         case $unit['status'] === 'not changed':
    //             return ["    {$unit['name']}" => $unit["value"]];

    //         case $unit['status'] === 'added':
    //             return ["  + {$unit['name']}" => $unit['value']];

    //         case $unit['status'] === 'removed':
    //             return ["  - {$unit['name']}" => $unit['value']];

    //         case $unit['status'] === 'changed':
    //             return ["  - {$unit['name']}" => $unit['oldValue'], "  + {$unit['name']}" => $unit['newValue']];

    //         case $unit['status'] === 'nested':
    //             return ["{$unit['name']}" => formatter($unit['child'])];
    //     }
    // }, $data);



    // return toString($result);
    return $result;
}
