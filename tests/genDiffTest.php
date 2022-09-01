<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class genDiffTest extends TestCase
{
    public function testGetDiffJson()
    {
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffJson');
        $result1 = genDiff(__DIR__ . "/../testFile/filePlain1.json", __DIR__ . "/../testFile/filePlain2.json");
        $this->assertEquals($correctDiff, $result1);

        $inCorrectDiff = "{incorrect:json}";
        $this->assertNotSame($inCorrectDiff, $result1);
    }

    public function testGetDiffYml()
    {
        $correctDiff = file_get_contents(__DIR__ . '/fixtures/correctDiffYml');
        $result1 = genDiff(__DIR__ . "/../TestFile/fileTest1.yaml", __DIR__ . "/../TestFile/fileTest2.yaml");
        $this->assertEquals($correctDiff, $result1);

        $inCorrectDiff = "{incorrect:yaml}";
        $this->assertNotSame($inCorrectDiff, $result1);
    }

}
