<?php
class GenericParse
{
    const TIME_PATTERN = PHP_EOL . 'Time: %8s  Words Processed: %d' . PHP_EOL;
    const TIME_DIFF    = PHP_EOL . 'Elapsed Time in Seconds: %d';
    protected $fp;
    public function __construct($fn)
    {
        $this->fp = new SplFileObject($fn, 'r');
    }
    public function getTextBad()
    {
        $num    = 0;
        $output = [];
        $this->fp->rewind();
        $line = $this->fp->fgets();
        while (!$this->fp->eof()) {
            $temp = str_word_count($line, 1);
            $output = array_merge($output, $temp);
            $line = $this->fp->fgets();
            printf(self::TIME_PATTERN, date('H:i:s'), ($num += count($temp)));
        }
        return $output;
    }
    public function getTextGood()
    {
        $num    = 0;
        $this->fp->rewind();
        $line = $this->fp->fgets();
        while (!$this->fp->eof()) {
            $temp = str_word_count($line, 1);
            yield from $temp;
            $line = $this->fp->fgets();
            printf(self::TIME_PATTERN, date('H:i:s'), ($num += count($temp)));
        }
    }
}

$run   = 'good';
$parse = new GenericParse('war_and_peace.txt');

$start  = time();
if ($run == 'good') {
	echo "\nUsing Generator";
	echo "\n------------------------------\n";
	foreach ($parse->getTextGood() as $word) {
		echo $word . ' ';
	}
} else {
	echo "\nConventional Approach";
	echo "\n------------------------------\n";
	$start  = time();
	foreach ($parse->getTextBad() as $word) {
		echo $word . ' ';
	}
}
$end = time();
printf(GenericParse::TIME_DIFF, ($end - $start));



