<?php

// Generate a range of dates using a period
$now = new DateTime('now');
$int = new DateInterval('P30D');
$period = new DatePeriod($now, $int, 12);

foreach ($period as $date) {
    echo $date->format('Y-m-d') . PHP_EOL;
}
echo PHP_EOL;

// Generate a range of dates using a period
$now = new DateTime('now');
$int = DateInterval::createFromDateString('first tuesday of every month');
$period = new DatePeriod($now, $int, 12);

foreach ($period as $date) {
    echo $date->format('Y-m-d') . PHP_EOL;
}




