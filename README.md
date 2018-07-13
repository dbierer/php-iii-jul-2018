# PHP-III CLASS NOTES -- Jul 2018

## HOMEWORK FOR MONDAY:
* Define an app that uses software events (or PubSub)
    * Define an EventManager class as a singleton
        * Define `attach()` which takes and event and a callable as arguments
            * The callable needs to accept an array of parameters
        * Define `trigger()` which runs the callable and passes an array of parameters
    * Define two other classes which get an instance of the EventManager
        * Have each of the other classes trigger one or more of the events
    * Create a calling program
        * Provides configuration to the EventManager and creates an instance
        * Creates instances of the other 2 classes and passes in the EventManager
        * Runs methods from the other 2 classes
* Use Iterators to do the following:
    * Do a recursive directory scan of the /php3/* directory structure
    * Use FilterIterator to include only *.php files
    * Use LimitIterator to paginate 20 items per page
    * Use InfiniteIterator to loop back to the beginning when you hit the last page


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

