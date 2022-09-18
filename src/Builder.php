<?php

namespace Differ\TestStylish;
// ./bin/gendiff testFile/deep1.json testFile/deep2.json

function union_merge($collectionFirst, $collectionSecond)
{
    $result = call_user_func_array('array_merge', func_get_args());
    return array_unique($result);
}

function builder(object $arrayFirst, object $arraySecond): array
{
    $keys = union_merge(array_keys(get_object_vars($arrayFirst)), array_keys(get_object_vars($arraySecond)));
    sort($keys);
    $unit = array_map(
        function ($key) use ($arrayFirst, $arraySecond) {
            if (!property_exists($arrayFirst, $key)) {
                return [
                    'name' => $key,
                    'status' => 'added',
                    'value' => $arraySecond->$key
                ];
            }
            if (!property_exists($arraySecond, $key)) {
                return [
                    'name' => $key,
                    'status' => 'removed',
                    'value' => $arrayFirst->$key
                ];
            }
            if (is_object($arraySecond->$key) && is_object($arrayFirst->$key)) {
                return [
                    'name' => $key,
                    'status' => 'nested',
                    'child' => builder($arrayFirst->$key, $arraySecond->$key)
                ];
            }
            if ($arrayFirst->$key === $arraySecond->$key) {
                return [
                    'name' => $key,
                    'status' => 'unchanged',
                    'value' => $arrayFirst->$key
                ];
            } else {
                return [
                    'name' => $key,
                    'status' => 'changed',
                    'newValue' => $arraySecond->$key,
                    'oldValue' => $arrayFirst->$key
                ];
            }
        },
        $keys
    );
    return $unit;
}
