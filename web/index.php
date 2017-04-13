<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/AppKernel.php';
use Symfony\Component\HttpFoundation\Request;

//$kernel = new AppKernel('prod', false);
$kernel = new AppKernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);