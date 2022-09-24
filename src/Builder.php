<?php

namespace Differ\TestStylish;

use function Functional\sort;

function builder(object $objFirst, object $objSecond): array
{
    $keyObjFirst = array_keys(get_object_vars($objFirst));
    $keyObjSecond = array_keys(get_object_vars($objSecond));
    $uniqueKeys = array_unique(array_merge($keyObjFirst, $keyObjSecond));

    $sortKeys = sort(
        $uniqueKeys,
        function ($left, $right) {
            return strcmp($left, $right);
        }
    );

    $keys = array_values($sortKeys);
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
