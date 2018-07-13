<?php
$array = ['A' => 1, 'B' => 2, 'C' => 3];
$it = new ArrayIterator($array);

var_dump($it);
echo PHP_EOL;

// use serialize to store the iterator some place (i.e. filesystem)
$storage = $it->serialize();

// here's how you get it back
$xyz = new ArrayIterator();
$xyz->unserialize($storage);
var_dump($xyz);

// ArrayObject
$ao = new ArrayObject($array);
$ao_it = $ao->getIterator();
var_dump($ao_it);

// directory iterator
$dir = new DirectoryIterator(__DIR__ );
foreach ($dir as $file) {
	echo $file->getPath() . '/' . $file->getBasename() . PHP_EOL;
}

// recursive directory iterator
echo "\nRecursiveIteratorIterator -- RecursiveDirectoryIterator\n";
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ ));
foreach ($dir as $file) {
	echo $file->getPath() . '/' . $file->getBasename() . PHP_EOL;
}

