<?php

namespace Differ\TestStylish;

// ./bin/gendiff testFile/deep1.json testFile/deep2.json

function builder(object $arrayFirst, object $arraySecond): array
{
    // $arrayMerge = get_object_vars($arrayFirst, $arraySecond);
    $keys = array_unique(array_merge(
        array_keys(get_object_vars($arrayFirst)),
        array_keys(get_object_vars($arraySecond))
    ));
    sort($keys);

    $unit = [];
    foreach ($keys as $key) {
        if (
            property_exists($arrayFirst, $key) &&
            property_exists($arraySecond, $key) &&
            $arrayFirst->$key === $arraySecond->$key
        ) {
            $unit[$key] = [
                'name' => $key,
                'status' => 'not changed',
                'value' => prepareValue($arraySecond->$key)
            ];
        } elseif (!property_exists($arrayFirst, $key)) {
            $unit[$key] = [
                'name' => $key,
                'status' => 'added',
                'value' => prepareValue($arraySecond->$key)
            ];
        } elseif (!property_exists($arraySecond, $key)) {
            $unit[$key] = [
                'name' => $key,
                'status' => 'removed',
                'value' => prepareValue($arrayFirst->$key)
            ];
        } elseif (
            property_exists($arrayFirst, $key) &&
            property_exists($arraySecond, $key) &&
            $arrayFirst->$key !== $arraySecond->$key &&
            !(is_object($arrayFirst->$key)) || !(is_object($arraySecond->$key))
        ) {
            $unit[$key] = [
                'name' => $key,
                'status' => 'changed',
                'newValue' => prepareValue($arraySecond->$key),
                'oldValue' => prepareValue($arrayFirst->$key)
            ];
        } else {
            if (is_object($arrayFirst->$key) && is_object($arraySecond->$key)) {
                $unit[$key] = [
                    'name' => $key,
                    'status' => 'nested',
                    'child' => builder($arrayFirst->$key, $arraySecond->$key)
                ];
            }
        }
    }
    return $unit;
}

// setting5 null?  
function prepareValue($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if (!is_object($value)) {
        return $value;
    }
}


