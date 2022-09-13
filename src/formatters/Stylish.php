<?php

namespace Differ\Formatters\Stylish;

function formatter(array $data): string
{
    return toString(iter($data));
}

function iter(array $data): array
{
    $result = [];
    foreach ($data as $unit) {
        $status = $unit['status'];
        $name = $unit['name'];
        switch ($status) {
            case 'unchanged':
                $result["{$name}"] = $unit['value'];
                break;
            case 'added':
                $result["+ {$name}"] = $unit['value'];
                break;
            case 'removed':
                $result["- {$name}"] = $unit['value'];
                break;
            case 'changed':
                $result["- {$name}"] = $unit['oldValue'];
                $result["+ {$name}"] = $unit['newValue'];
                break;
            case 'nested':
                $result["{$name}"] = iter($unit['child']);
                break;
            default:
                throw new \Exception("Incorrect status '{$status}'.");
        }
    }
    return $result;
}

// не нравиться такой подход
function toString(array $formatted): string
{
    $formatted = (string) json_encode($formatted, JSON_PRETTY_PRINT);
    $result = str_replace(",", '', str_replace('"', '', $formatted));
    $result = str_replace("  - ", "- ", str_replace("  + ", "+ ", $result));
    return $result;
}
