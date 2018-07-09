<?php
class GenericParse
{
    protected $fp;
    public function __construct($fn)
    {
        $this->fp = new SplFileObject($fn, 'r');
    }
    public function getTextBad()
    {
        $output = [];
	$line = $this->fp->fgets();
	while (!$this->fp->eof()) {
	    $temp = str_word_count($line, 1);
            $output = array_merge($output, $temp);
	    $line = $this->fp->fgets();
	}
        return $output;
    }
    public function getTextGood()
    {
	$line = $this->fp->fgets();
	while (!$this->fp->eof()) {
	    yield str_word_count($line, 1);
	    $line = $this->fp->fgets();
	}
    }
}

$parse = new GenericParse('war_and_peace.txt');


foreach ($parse->getTextGood() as $word) {
    echo $word . ' ';
}


