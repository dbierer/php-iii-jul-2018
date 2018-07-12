<?php

$add = new class () {
	public function __invoke($a, $b) 
	{
		return $a + $b;
	}
};

$sub = new class () {
	public function __invoke($a, $b) 
	{
		return $a - $b;
	}
};

$mul = new class () {
	public function __invoke($a, $b) 
	{
		return $a * $b;
	}
};

$manager = new class () {
	protected $events;
	public function attach($event, $listener)
	{
		$this->events[$event] = $listener;
	}
	public function trigger($event, $a, $b)
	{
		// this syntax is only allowed in PHP 7 and above!
		return $this->events[$event]($a, $b);
	}
};

$manager->attach('add', $add);
$manager->attach('sub', $sub);
$manager->attach('mul', $mul);

echo $manager->trigger('mul', 3, 3);

		
		
