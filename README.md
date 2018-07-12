# PHP-III CLASS NOTES -- Jul 2018

## HOMEWORK:
* Setup Apache JMeter
* Setup Jenkins

## Example of DatePeriod
* You can use [Relative Formats](http://php.net/manual/en/datetime.formats.relative.php)
  with `DateInterval::createFromDateString ( string $time )`

## Q & A
* RE: http://localhost:9999/#/2/31: if offset === NULL, what array key is it???
* RE: http://localhost:9999/#/2/37: example doesn't work in /php3 folder
* RE: Generator class: pull up an example showing a Generator instance
* RE: Null Coalesce: https://github.com/dbierer/php7_examples/blob/master/php_7_0/null_coalesce_operator.php

## NOTES
* http://localhost:9999/#/2/13: could also just say
```
public function getDimensions() {
        yield from $this->widths;
        yield from $this->lengths;
    }
```

* PHP 7 Examples: https://github.com/dbierer/php7_examples

