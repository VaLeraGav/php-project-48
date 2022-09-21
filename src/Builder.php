<?php

namespace Differ\TestStylish;

// use function Funct\Collection\union;
// use function Funct\Collection\sortBy;

function builder(object $objFirst, object $objSecond): array
{
    $keys = funct_union(array_keys(get_object_vars($objFirst)), array_keys(get_object_vars($objSecond)));
    // sort($keys);
    $sortKeys = sortBy($keys, fn ($key) => $key);
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


/**
 * Returns a sorted array by callback function which should return value to which sort
 *
 * @param array           $collection
 * @param callable|string $sortBy
 * @param string          $sortFunction
 *
 * @return array
 */
function sortBy($collection, $sortBy, $sortFunction = 'asort')
{
    $bool = is_callable($sortBy);
    if (false ===  $bool) {
        $sortBy = function ($item) use ($sortBy) {
            return $item[$sortBy];
        };
    }

    $values = array_map($sortBy, $collection);
    $sortFunction($values);

    $result = [];
    foreach ($values as $key => $value) {
        $result[$key] = $collection[$key];
    }

    return $result;
}

/**
 * Computes the union of the passed-in arrays: the list of unique items, in order, that are present in one or more of
 * the arrays.
 *
 * @param array $collectionFirst
 * @param array $collectionSecond
 *
 * @return array
 */
function funct_union($collectionFirst, $collectionSecond)
{
    $result = call_user_func_array('array_merge', func_get_args());

    return array_unique($result);
}
