<?php
define('CUSTOMER_FILE', __DIR__ . '/customer.csv');

include __DIR__ . '/spl_linked_list_include.php';

// get customer data
$headers = array();
$customer = readCsv(CUSTOMER_FILE, $headers);

// callback to produce link
// NOTE: link becomes the key which *must* be unique!

/*
// produces a list in order of ID
$makeLink = function ($row) {
    return $row[0];
};
*/

// produces a list in order of last name, first name
$makeLink = function ($row) {
    list($first, $last) = explode(' ', $row[1]);
    return trim($last) . trim($first);
};

// produce linked list
$linked = buildLinkedList($customer, $makeLink);

// doubly linked list
$double = buildDoublyLinkedList($linked);
// IT_MODE_FIFO  == Ascending Order
// IT_MODE_LIFO  == Descending Order
$double->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);

// produce output based on linked list
echo printCustomer($headers, $double, $customer);
