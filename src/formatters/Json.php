<?php

namespace Differ\Formatters\Json;

function formatter(string $data): string
{
    return json_encode($data, JSON_THROW_ON_ERROR);
}