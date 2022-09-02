<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function readFile($filePath): void
{
    if (!file_exists($filePath)) {
        throw new \Exception("The file {$filePath} does not exists.\n");
    }
}

function parser(string $path): array
{
    readFile($path);
    $splitPath = pathinfo($path);
    $format = $splitPath['extension'];
    switch ($format) {
        case 'json':
            return json_decode(file_get_contents($path), true);
            break;
        case 'yaml':
        case 'yml':
            return Yaml::parseFile($path);
            break;
        default:
            throw new \Exception("Data type '{$format}' is incorrect or not supported.");
    }
}

// $title = '/file/file.json';
// parser($title);
