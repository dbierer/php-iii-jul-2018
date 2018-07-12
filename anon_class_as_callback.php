<?php
$callback = new class {
    public function __invoke($element) {
        return $element * 10 ;
    }
};

$array = [1, 2, 3, 4];
$result = array_map($callback, $array);
var_dump($result);

// another example:

echo PHP_EOL;
function tenFactor() {
    return new class () {
		public function timesTen($element) 
		{
			return $element * 10;
		}
	};
}

// this syntax is allowed in PHP 7 and above:
echo tenFactor()->timesTen(10);
