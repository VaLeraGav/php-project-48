<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class genDiffTest extends TestCase
{
    // ______________Stylish________________

    public function testGetDiffSimpleJson()
    {
        // $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffJson');
        $result1 = genDiff(__DIR__ . "/../testFile/simple10.json", __DIR__ . "/../testFile/simple20.json");
        print_r($result1);
        // $this->assertEquals($correctDiff, $result1);

        // $inCorrectDiff = "{incorrect:json}";
        // $this->assertNotSame($inCorrectDiff, $result1);
    }

    public function testGetDiffSimpleYml()
    {
        // $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffYml');
        $result1 = genDiff(__DIR__ . "/../testFile/simple1.yaml", __DIR__ . "/../testFile/simple2.yaml");
        print_r($result1);
        // $this->assertEquals($correctDiff, $result1);

        // $inCorrectDiff = "{incorrect:yaml}";
        // $this->assertNotSame($inCorrectDiff, $result1);
    }

    public function testGetDiffDeepJson()
    {
        // $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffYml');
        $result1 = genDiff(__DIR__ . "/../testFile/deep1.json", __DIR__ . "/../testFile/deep2.json");
        print_r($result1);
        // $this->assertEquals($correctDiff, $result1);

        // $inCorrectDiff = "{incorrect:yaml}";
        // $this->assertNotSame($inCorrectDiff, $result1);
    }
    public function testGetDiffDeepYaml()
    {
        // $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffYml');
        $result1 = genDiff(__DIR__ . "/../testFile/deep10.yaml", __DIR__ . "/../testFile/deep20.yaml");
        print_r($result1);
        // $this->assertEquals($correctDiff, $result1);

        // $inCorrectDiff = "{incorrect:yaml}";
        // $this->assertNotSame($inCorrectDiff, $result1);
    }

    // ______________Json________________

    // public function testGetDiffSimpleJsonToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/simple10.json", __DIR__ . "/../testFile/simple20.json", 'json');
    //     print_r($result1);
    // }

    // public function testGetDiffSimpleYmlToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/simple1.yaml", __DIR__ . "/../testFile/simple2.yaml", 'json');
    //     print_r($result1);
    // }

    // public function testGetDiffDeepJsonToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/deep1.json", __DIR__ . "/../testFile/deep2.json", 'json');
    //     print_r($result1);
    // }
    // public function testGetDiffDeepYamlToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/deep10.yaml", __DIR__ . "/../testFile/deep20.yaml", 'json');
    //     print_r($result1);
    // }

    // ______________Plain________________

    // public function testGetDiffSimplePlainToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/simple10.json", __DIR__ . "/../testFile/simple20.json", 'plain');
    //     print_r($result1);
    // }

    // public function testGetDiffDeepPlainToJson()
    // {
    //     $result1 = genDiff(__DIR__ . "/../testFile/deep1.json", __DIR__ . "/../testFile/deep2.json", 'plain');
    //     print_r($result1);
    // }
}
