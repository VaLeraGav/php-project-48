<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function readFile(string $filePath): void
{
    if (!file_exists($filePath)) {
        throw new \Exception("The file {$filePath} does not exists.\n");
    }
}

function parser(string $path): object
{
    readFile($path);
    $splitPath = pathinfo($path);
    $format = $splitPath['extension'];

    switch ($format) {
        case 'json':
            return json_decode(file_get_contents($path), false);
            break;
        case 'yaml':
        case 'yml':
            return Yaml::parse(file_get_contents($path), Yaml::PARSE_OBJECT_FOR_MAP);
            break;
        default:
            throw new \Exception("Data type '{$format}' is incorrect or not supported.");
    }
}
