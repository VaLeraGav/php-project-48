<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

function getTestFixturesPath($fileName)
{
    return __DIR__ . "/../tests/fixtures/{$fileName}";
}

class GenDiffTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testGenDiff(string $expected, string $file1, string $file2, string $format)
    {
        $this->assertStringEqualsFile(getTestFixturesPath($expected), genDiff(getTestFixturesPath($file1), getTestFixturesPath($file2), $format));
    }

    public function additionProvider()
    {
        return [
            ['correctDeepPlain.txt', 'deep1.json', 'deep2.json', 'plain'],
            ['correctDeepStylish.txt', 'deep1.json', 'deep2.json', 'stylish'],
            ['correctDeepStylish.txt', 'deep10.yaml', 'deep20.yaml', 'stylish'],
            ['correctSimpleJson.txt', 'simple10.json', 'simple20.json', 'json'],
            ['correctSimplePlain.txt', 'simple10.json', 'simple20.json', 'plain'],
            ['correctSimpleStylish.txt', 'simple10.json', 'simple20.json', 'stylish'],
        ];
    }
}
