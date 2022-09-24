<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parser(string $path): object
{
    if (!file_exists($path)) {
        throw new \Exception("The file {$path} does not exists.\n");
    }
    $stringData = (string) file_get_contents($path);

    $format = pathinfo($path, PATHINFO_EXTENSION);
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
