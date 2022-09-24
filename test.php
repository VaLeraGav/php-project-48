<?php

require_once "../php-project-lvl2//vendor/autoload.php";

use function Functional\sort as f_sort;

function BubbleSort(array $data)
{
    $count_elements = count($data);
    $iterations = $count_elements - 1;

    for ($i = 0; $i < $count_elements; $i++) {
        $changes = false;
        for ($j = 0; $j < $iterations; $j++) {
            if ($data[$j] > $data[($j + 1)]) {
                $changes = true;
                list($data[$j], $data[($j + 1)]) = array($data[($j + 1)], $data[$j]);
            }
        }
        $iterations--;
        if (!$changes) {
            return $data;
        }
    }
    return $data;
}

$array = ["verbose", "id", "host",  "timeout", "proxy", "follow",];
$sort = f_sort($array, function ($left, $right) {
    return strcmp($left, $right);
});
print_r($sort);


    // - follow: false
    //   host: hexlet.io
    // + id: 9
    // - proxy: 123.234.53.22
    // - timeout: 50
    // + timeout: 20
    // + verbose: true


        // "verbose": true,
        // "id": 9
        // "host": "hexlet.io",
        // "timeout": 50,
        // "proxy": "123.234.53.22",
        // "follow": false
