<?php
// setup class autoloading
//require __DIR__ . '/Application/Autoload/Loader.php';

// add current directory to the path
//Application\Autoload\Loader::init(__DIR__);

$loader1 = function ($class) 
{
	$list = ['Application\\PubSub\\Publisher' => __DIR__ . '/Application/PubSub/Publisher.php'];
	if (isset($list[$class])) {
		echo __LINE__;
		require_once($list[$class]);
	}
};

$loader2 = function ($class) 
{
		echo __LINE__;
	$fn = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
	require_once $fn;
};

spl_autoload_register($loader1);
spl_autoload_register($loader2);

use Application\PubSub\ { Publisher, Subscriber };

$pub = new Publisher('test');
$pub->setDataByKey('1', 'AAA');
$pub->setDataByKey('2', 'BBB');
$pub->setDataByKey('3', 'CCC');
$pub->setDataByKey('4', 'DDD');

// set up callbacks
$callback1 = function ($pub) {echo '1:' . $pub->getData()[1] . PHP_EOL;};
$callback2 = function ($pub) {echo '2:' . $pub->getData()[2] . PHP_EOL;};
$callback3 = function ($pub) {echo '3:' . $pub->getData()[3] . PHP_EOL;};
$callback4 = function ($pub) {
    echo '4:' . $pub->getData()[4] . PHP_EOL;
    if (!empty($pub->getData()[1])) die('1 is set ... halting execution');
};

// set up subscribers
$sub2 = new Subscriber('2', $callback2, 20);
$sub1 = new Subscriber('1', $callback1, 10);
$sub3 = new Subscriber('3', $callback3, 99);

echo "\nFirst Set:\n";
$pub->attach($sub2);
$pub->attach($sub1);
$pub->attach($sub3);
$pub->notify();
$pub->notify();

echo "\nSecond Set:\n";
$sub4 = new Subscriber('4', $callback4, 25);
$pub->attach($sub4);
$pub->notify();
