<?php
// TO RUN THIS DEMO:
/*
 * 1. Run "composer update" to install stratigility, etc.
 * 2. From this directory run this command: "php -S localhost:9999"
 * 3. From your browser enter this URL: "http://localhost:9999"
 */

define('LOG_FILE', __DIR__ . '/access.log');
define('MENU', '<a href="/">Home Page</a><br><a href="/main">Main Page</a><br><a href="/main">Foo Page</a><br><a href="/view">View Log</a>');

// main classes needed
use Zend\Diactoros\Response;
use Zend\Diactoros\Server;
use Zend\Stratigility\Middleware\NotFoundHandler;
use Zend\Stratigility\MiddlewarePipe;

// NOTE: these are *functions* which provide convient wrappers:
//       "middleware()" produces middleware from anonymous functions
//       "path()" addes routing and requires that you call "middleware()" as 2nd argument

use function Zend\Stratigility\middleware;
use function Zend\Stratigility\path;

require __DIR__ . '/vendor/autoload.php';

$app = new MiddlewarePipe();
$server = Server::createServer([$app, 'handle'], $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

// this one just writes to a log file
$log = function ($req, $handler) {
    $text = sprintf('%20s : %10s : %16s : %s' . PHP_EOL,
                    date('Y-m-d H:i:s'),
                    $req->getUri()->getPath(),
                    ($req->getHeaders()['accept'][0] ?? 'N/A'),
                    ($req->getServerParams()['REMOTE_ADDR']) ?? 'Command Line');
    file_put_contents(LOG_FILE, $text, FILE_APPEND);
    return $handler->handle($req);
};

// middleware: landing page
$main = function ($req, $handler) {
    $response = new Response();
    $response->getBody()->write('<h1>Main Page</h1>' . MENU);
    return $response;
};

// middleware: foo page
$foo = function ($req, $handler) {
    $response = new Response();
    $response->getBody()->write('<h1>FOO Page</h1>' . MENU);
    return $response;
};

// middleware: foo page
$view = function ($req, $handler) {
    $response = new Response();
    $contents = file_get_contents(LOG_FILE);
    $response->getBody()->write('<h1>View Access Log</h1><pre>' . $contents . '</pre>' . MENU);
    return $response;
};

// middleware: home page
$home = function ($req, $handler) {
    if (! in_array($req->getUri()->getPath(), ['/', ''], true)) {
        return $handler->handle($req);
    }
    $response = new Response();
    $response->getBody()->write('<h1>Home Page</h1>' . MENU);
    return $response;
};

$app->pipe(middleware($log));

// NOTE: pages have to go in the pipe in reverse!
// Foo page
$app->pipe(path('/foo', middleware($foo)));

// View page
$app->pipe(path('/view', middleware($view)));

// Main page
$app->pipe(path('/main', middleware($main)));

// Home page
$app->pipe(middleware($home));

// 404 handler
$app->pipe(new NotFoundHandler(function () {
    return new Response();
}));

$server->listen(function ($req, $res) {
    return $res;
});
