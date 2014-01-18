<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../app/routes.php';
$sc = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

$controller = new Acme\Controller\LeapYearController;
$response = $sc->get('framework')->handle($request);
$response->send();
