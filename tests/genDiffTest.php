<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

function getTestFilePath($fileName)
{
    return __DIR__ . "/../testFile/{$fileName}";
}

class genDiffTest extends TestCase
{
    // ______________Stylish________________

    public function testGetDiffSimpleJson()
    {
        $file1 = 'simple10.json';
        $file2 = 'simple20.json';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Json/correctSimple');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2)));
    }

    public function testGetDiffSimpleYml()
    {
        $file1 = 'simple1.yaml';
        $file2 = 'simple2.yaml';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Yml/correctSimple');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2)));
    }

    public function testGetDiffDeepJson()
    {
        $file1 = 'deep1.json';
        $file2 = 'deep2.json';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Json/correctDeep');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2)));
    }

    public function testGetDiffDeepYaml()
    {
        $file1 = 'deep10.yaml';
        $file2 = 'deep20.yaml';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Yml/correctDeep');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2)));
    }

    // ______________Plain________________

    public function testGetDiffSimpleJsonToPlain()
    {
        $file1 = 'simple10.json';
        $file2 = 'simple20.json';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Plain/correctSimple');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), 'plain'));
    }

    public function testGetDiffSimpleYmlToPlain()
    {
        $file1 = 'simple1.yaml';
        $file2 = 'simple2.yaml';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Plain/correctSimple');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), 'plain'));
    }

    public function testGetDiffDeepJsonToPlain()
    {
        $file1 = 'deep1.json';
        $file2 = 'deep2.json';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Plain/correctDeep');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), 'plain'));
    }
    public function testGetDiffDeepYamlToPlain()
    {
        $file1 = 'deep10.yaml';
        $file2 = 'deep20.yaml';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Plain/correctDeep');
        $correctDiff= str_replace(array("\r"),"", $correctDiff);
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), 'plain'));
    }

    // ______________Json________________

    public function testGetDiffSimplePlainToJson()
    {
        $file1 = 'simple10.json';
        $file2 = 'simple20.json';
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/Json/correctSimple2');
        $this->assertEquals($correctDiff, genDiff(getTestFilePath($file1), getTestFilePath($file2), 'json'));
    }
}
