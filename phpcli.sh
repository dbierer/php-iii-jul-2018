!#/usr/bin/php
<?php
$message = 'No Params';
var_dump($argv ?? $_SERVER['argv'] ?? $message);
