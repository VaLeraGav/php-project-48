<?php

namespace Differ\Formatters\Stylish;

function formatter( $data)
{
    $result = iter($data);
    return "{\n{$result}\n}";
}

function iter($data)
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
