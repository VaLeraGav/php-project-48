<?php

namespace Differ\Formatters\Plain;

function formatter(array $data, string $ancestry = '')
{
    $data = array_filter($data, fn ($unit) => $unit['status'] !== 'unchanged');

    $lines = array_map(function ($elem) use ($ancestry) {
        $newAncestry = $ancestry . $elem['name'];
        $status = $elem['status'];

        switch ($status) {
            case 'nested':
                return formatter($elem['child'], "{$newAncestry}.");

            case 'added':
                $value = checkArray($elem['value']);
                return "Property '{$newAncestry}' was added with value: {$value}";

            case 'removed':
                return "Property '{$newAncestry}' was removed";

            case 'changed':
                $newValue = checkArray($elem['newValue']);
                $newValue = ($newValue === 'NULL') ? 'null' : $newValue;
                $oldValue = checkArray($elem['oldValue']);
                $oldValue = ($oldValue === 'NULL') ? 'null' : $oldValue;
                return "Property '{$newAncestry}' was updated. From {$oldValue} to {$newValue}";

            default:
                throw new \Exception("Incorrect status '{$status}'.");
        };
    }, $data);
    $result = implode("\n", $lines);
    return $result;
}

function checkArray($val): string
{
    if (is_object($val)) {
        return "[complex value]";
    }
    return var_export($val, true);
}
