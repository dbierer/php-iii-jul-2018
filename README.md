# PHP-III CLASS NOTES -- Jul 2018

## HOMEWORK:
* Setup Apache JMeter
* Setup Jenkins
* For Doug: get Generator example working

## Example of DatePeriod
* You can use [Relative Formats](http://php.net/manual/en/datetime.formats.relative.php)
  with `DateInterval::createFromDateString ( string $time )`

## NOTES
* http://localhost:9999/#/2/13: could also just say
```
public function getDimensions() {
        yield from $this->widths;
        yield from $this->lengths;
    }
```

