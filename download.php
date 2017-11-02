<?php

use YandexDiskApi\Disk;

include __DIR__ . '/vendor/autoload.php';

$cmdParam = new Commando\Command();
$cmdParam->option('src')
    ->aka('s')
    ->require(true)
    ->describedAs('File on Yandex\'s server');

$cmdParam->option('dst')
    ->aka('d')
    ->require(true)
    ->describedAs('File on own server');

$cmdParam->option('token')
    ->aka('t')
    ->require(true)
    ->describedAs('Token of Yandex\'s api');

$srcFile = $cmdParam['src'];
if (empty($srcFile)) {
    echo 'Error: Src path must not be empty', PHP_EOL;
    exit(2);
}

$dstFile = $cmdParam['dst'];
if (empty($dstFile)) {
    echo 'Error: Dist path must not be empty', PHP_EOL;
    exit(3);
}

$token = $cmdParam['token'];
if (empty($token)) {
    echo 'Error: Token must not be empty', PHP_EOL;
    exit(4);
}

try {
    $disk = new Disk($token);
    $disk->download($srcFile, $dstFile);
} catch (\Exception $ex) {
    echo 'Error: ', $ex->getMessage(), PHP_EOL;
    exit(5);
}
