<?php

namespace Differ\TestStylish;

use function Funct\Collection\union;
use function Funct\Collection\sortBy;

function builder(object $objFirst, object $objSecond): array
{
    $keys = union(array_keys(get_object_vars($objFirst)), array_keys(get_object_vars($objSecond)));
    // sort($keys);
    $keys = array_values(sortBy($keys, fn($key) => $key));
    $unit = array_map(
        function ($key) use ($objFirst, $objSecond) {
            if (!property_exists($objFirst, $key)) {
                return [
                    'name' => $key,
                    'status' => 'added',
                    'value' => $objSecond->$key
                ];
            }
            if (!property_exists($objSecond, $key)) {
                return [
                    'name' => $key,
                    'status' => 'removed',
                    'value' => $objFirst->$key
                ];
            }
            if (is_object($objSecond->$key) && is_object($objFirst->$key)) {
                return [
                    'name' => $key,
                    'status' => 'nested',
                    'child' => builder($objFirst->$key, $objSecond->$key)
                ];
            }
            if ($objFirst->$key === $objSecond->$key) {
                return [
                    'name' => $key,
                    'status' => 'unchanged',
                    'value' => $objFirst->$key
                ];
            } else {
                return [
                    'name' => $key,
                    'status' => 'changed',
                    'newValue' => $objSecond->$key,
                    'oldValue' => $objFirst->$key
                ];
            }
        },
        $keys
    );
    return $unit;
}
