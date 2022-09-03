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
    return $result;
}
