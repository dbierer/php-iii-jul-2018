# PHP-III CLASS NOTES -- Jul 2018

NOTE TO SELF: copy instructions on PHP driver install into the repo
NOTE TO SELF: find customer server example using STDIN

## HOMEWORK
### FOR MON 23 Jul 2018
* OPTIONAL Extension Lab: 
  * Install MongoDB on the VM
  * Install the PHP driver
* Apache JMeter Lab
  * It's *not* locked to the launcher
  * Click on extreme top left search icon
  * Start typing `jmeter`
  * Click on the feather
* All the Docker Labs in Chapter 6
  * To add an entry to the local hosts file
  * Find the IP address for the docker image by typing `ifconfig`
  * Add that to the `/etc/hosts` file on the VM:
```
sudo gedit /etc/hosts
```
  * Add ip address and host name of your choice
  * To confirm: `ping -c3 host.name`


### FOR FRI 20 Jul 2018
* Extension Custom Development Lab
* Custom PHP Lab
* CD Phing Build Tool Lab
* Continuous Delivery Lab


### FOR WEDS 18 Jul 2018
* Built-in Web Server Lab

### FOR MON 16 Jul 2018
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
  * A: stays at the same pointer
  * Please confirm!
* RE: http://localhost:9999/#/2/37: example doesn't work in /php3 folder
* RE: Generator class: pull up an example showing a Generator instance
  * A: See: `generator.php` in this repo
* RE: Null Coalesce: https://github.com/dbierer/php7_examples/blob/master/php_7_0/null_coalesce_operator.php
* http://localhost:9999/#/2/13: could also just say
```
public function getDimensions() {
        yield from $this->widths;
        yield from $this->lengths;
    }
```
* RE: stdin: please find example of mini-server
* RE: stream filters: please find example of encryption filter

## NOTES

### PHP 7
* PHP 7 Examples: https://github.com/dbierer/php7_examples

### Data Structures
* Heap: https://en.wikipedia.org/wiki/Heap_%28data_structure%29
  * NOTE: a _priority queue_ is an implementation of a heap
* Note other examples which are now in the repo

### PHP CLI
* Capture command line parameters using either `$argv[]` or `$_SERVER['argv'][]`

### Cache
* [PSR-16](https://www.php-fig.org/psr/psr-16/) is a simplified version of cache based on PSR-6
* Have a look at http://php.net/manual/en/book.apc.php

### Custom PHP
* The download URL varies depending on the code name for the release.  The example shown in the slides is "krakjoe" which is 7.1.  The upcoming version 7.3 has a codename "cmb".
* Just click on the link shown on the main page of http://php.net/
* Here is another example of a PHP custom installation `configure` command string: https://github.com/dbierer/php7_examples#manual-php-7-installation
* You can also use `php -i` (from the command line) or `phpinfo()` (from a browser) to get the `configure` string used for an existing installation

### RE: Thread Safe (TS) vs. Non-Thread Save (NTS) on Windows
* https://stackoverflow.com/questions/7204758/php-thread-safe-and-non-thread-safe-for-windows

### Docker
* No longer have to install `boot2docker` when installing on Windows or Mac
* Look here: https://docs.docker.com/machine/install-machine/
