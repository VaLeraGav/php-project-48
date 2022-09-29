<?php

namespace Differ\Formatters;

function format(string $format, array $tree): string
{
    switch ($format) {
        case 'json':
            return Json\format($tree);
        case 'plain':
            return Plain\format($tree);
        case 'stylish':
            return Stylish\format($tree);
        default:
            throw new \Exception("The {$format} format is not supported");
    }
}
