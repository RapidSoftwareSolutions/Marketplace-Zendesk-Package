<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/AppKernel.php';
use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('prod', false);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
exit();
$response->send();
$kernel->terminate($request, $response);