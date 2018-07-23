<?php
// demo reading a config file
 
// this doesn't give us the config array!
$config = 'config.php';
var_dump($config);
// Result: string(10) "config.php"

// this doesn't give us the config array!
$config = file_get_contents('config.php');
var_dump($config);
// Result: exact contents of the file in the form of a string

// this works!
$config = include 'config.php';
var_dump($config);
// Result: array w/ 'database' => ['username' => xxx etc.]


