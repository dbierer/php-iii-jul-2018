<?php
// demonstrates the difference between *Iterator, Recursive*Iterator and RecursiveIteratorIterator

try {

    // DirectoryIterator
    $iterator = new DirectoryIterator(__DIR__);
    echo "\nDirectoryIterator";
    echo "\n------------------------------------\n";
    foreach ($iterator as $item) echo trim($item) . PHP_EOL;
    echo PHP_EOL;

    // RecursiveDirectoryIterator
    $shallow  = new RecursiveDirectoryIterator(__DIR__);
    echo "\nRecursiveDirectoryIterator";
    echo "\n------------------------------------\n";
    foreach ($shallow as $item) echo trim($item) . PHP_EOL;
    echo PHP_EOL;

    // RecursiveIteratorIterator
    $deep     = new RecursiveIteratorIterator($shallow);
    echo "\nRecursiveIteratorIterator";
    echo "\n------------------------------------\n";
    foreach ($deep as $item) echo trim($item) . PHP_EOL;
    echo PHP_EOL;

} catch (Throwable $e) {
    echo $e->getMessage();
}

