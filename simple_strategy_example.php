<?php
declare(strict_types=1);

$strategies = [
    'add' => new class() {public function __invoke($a, $b) { return $a + $b; }},
    'sub' => new class() {public function __invoke($a, $b) { return $a - $b; }},
    'mul' => new class() {public function __invoke($a, $b) { return $a * $b; }},
    'div' => new class() {public function __invoke($a, $b) { return ($a && $b) ? $a / $b : 0; }},
];

class Strategy
{
    protected $strategies;
    public function __construct($strategies)
    {
        $this->strategies = $strategies;
    }
    public function calc(string $op)
    {
        $matches = [];
        preg_match('/(\d+) (.) (\d+)/', $op, $matches);
        if (!$matches || !isset($matches[2])) {
            return $this->error();
        }
        switch ($matches[2]) {
            case '+' :
                $key = 'add';
                break;
            case '-' :
                $key = 'sub';
                break;
            case '*' :
                $key = 'mul';
                break;
            case '/' :
                $key = 'div';
                break;
            default :
                return $this->error();
        }
        return $this->strategies[$key]($matches[1], $matches[3]) . PHP_EOL;
    }
    public function error()
    {
        return 'ERROR: illegal operation: operation must be in this form: "NN +|-|*|/ NN"';
    }
}

$strategy = new Strategy($strategies);
echo $strategy->calc('2 + 3');
echo $strategy->calc('2 * 3');
echo $strategy->calc('2 - 3');
echo $strategy->calc('2 / 3');
echo $strategy->calc('2 / 0');
echo $strategy->calc('2 & 3');

// output:
/*
5
6
-1
0.66666666666667
0
ERROR: illegal operation: operation must be in this form: "NN +|-|*|/ NN"
*/

