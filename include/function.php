<?php

$file_list = scandir(__DIR__ . '/function');
$file_list = array_slice($file_list, 2);

foreach ($file_list as $item)
{
    include(__DIR__ . '/function/' . $item);
}