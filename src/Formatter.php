<?php

namespace Differ\Formatters;

function format(string $format, array $tree)
{
    switch ($format) {
        case 'json':
            return Json\formatter($tree);
        case 'plain':
            return Plain\formatter($tree);
        case 'stylish':
            return toString(Stylish\formatter($tree));
        default:
            throw new \Exception("The {$format} format is not supported");
    }
}

function toString(array $formatted): string
{
    $formatted = (string) json_encode($formatted, JSON_PRETTY_PRINT);
    $result = str_replace(",", '', str_replace('"', '', $formatted));
    return $result;
}