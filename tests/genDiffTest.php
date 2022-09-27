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
    public function testGenDiff(string $correctDiff, string $file1, string $file2, string $format)
    {

        
        $correctDiff = file_get_contents(getTestFixturesPath($correctDiff));
        $correctDiff = str_replace(array("\r"), "", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFixturesPath($file1), getTestFixturesPath($file2), $format));

        // $this->assertStringEqualsFile($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), $format));
    }

    public function additionProvider()
    {
        return [
            ['correctDeepPlain', 'deep1.json', 'deep2.json', 'plain'],
            ['correctDeepStylish', 'deep1.json', 'deep2.json', 'stylish'],
            ['correctDeepStylish', 'deep10.yaml', 'deep20.yaml', 'stylish'],
            ['correctSimpleJson', 'simple10.json', 'simple20.json', 'json'],
            ['correctSimplePlain', 'simple10.json', 'simple20.json', 'plain'],
            ['correctSimpleStylish', 'simple10.json', 'simple20.json', 'stylish'],
        ];
    }
}
