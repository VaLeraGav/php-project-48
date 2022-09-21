<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function readFile(string $filePath): string
{
    if (!file_exists($filePath)) {
        throw new \Exception("The file {$filePath} does not exists.\n");
    }
    return $filePath;
}

function parser(string $path): object
{
    $path = readFile($path);
    // $splitPath = pathinfo($path);
    // $format = $splitPath['extension'];
    $format = pathinfo($path, PATHINFO_EXTENSION);
    $stringData = (string) file_get_contents($path);
    switch ($format) {
        case 'json':
            return json_decode($stringData, false);
        case 'yaml':
        case 'yml':
            return Yaml::parse($stringData, Yaml::PARSE_OBJECT_FOR_MAP);
        default:
            throw new \Exception("Data type '{$format}' is incorrect or not supported.");
    }
}
