<?php

namespace Differ\Formatters\Plain;

// use function Funct\Collection\compact;

/**
 * Returns a copy of the array with all falsy values removed
 *
 * @param array $collection
 *
 * @return array
 * @author Aurimas Niekis <aurimas@niekis.lt>
 */
function compact($collection)
{
    return array_filter($collection);
}


function formatter(array $data): string
{
    return iter($data);
}

function iter(array $data, string $ancestry = null)
{
    $plain = array_map(function ($unit) use ($ancestry) {
        $newAncestry = $ancestry . $unit['name'];
        $status = $unit['status'];

        switch ($status) {
            case 'nested':
                return iter($unit['child'], "{$newAncestry}.");

            case 'added':
                $value = checkArray($unit['value']);
                return "Property '{$newAncestry}' was added with value: {$value}";

            case 'removed':
                return "Property '{$newAncestry}' was removed";

            case 'changed':
                $newValue = checkArray($unit['newValue']);
                $oldValue = checkArray($unit['oldValue']);
                return "Property '{$newAncestry}' was updated. From {$oldValue} to {$newValue}";
            case 'unchanged':
                return;
            default:
                throw new \Exception("Incorrect status '{$status}'.");
        };
    }, $data);
    // $data = compact($plain);
    $data = array_filter($plain, fn ($key) => $key);
    $result = implode("\n", $data);
    return $result;
}

function checkArray($value): string
{
    if (is_array($value) || is_object($value)) {
        return "[complex value]";
    }
    if (is_null($value)) {
        return 'null';
    }
    return var_export($value, true);
}
