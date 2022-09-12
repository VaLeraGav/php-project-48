<?php

namespace Differ\Formatters;

function format(string $format, array $tree): string
{
    switch ($format) {
        case 'json':
            return Json\formatter($tree);
        case 'plain':
            return Plain\formatter($tree);
        case 'stylish':
            return Stylish\formatter($tree);
        default:
            throw new \Exception("The {$format} format is not supported");
    }
}
