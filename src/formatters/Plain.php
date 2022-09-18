<?php

namespace Differ\Formatters\Plain;

function formatter($data)
{
    return iter($data);
}

function iter($data, $ancestry = null)
{
    $lines = array_map(function ($unit) use ($ancestry) {
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
    $data = array_filter($lines);
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
    // if (is_bool($value)) {
    //     return $value ? 'true' : 'false';
    // }
    // return is_numeric($value) ? (string) $value : "'$value'";
    return var_export($value, true);

}
