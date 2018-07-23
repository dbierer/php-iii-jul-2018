<?php
// parse_url
$url = 'www.zend.com/en/services/training?id=1&view=index&component=user';
$parsed = parse_url($url);
var_dump($parsed);

// base64
$encoded = base64_encode($url);
echo $encoded . PHP_EOL;
echo base64_decode($encoded) . PHP_EOL;

// urlencode
echo urlencode($url) . PHP_EOL;


