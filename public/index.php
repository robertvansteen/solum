<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

//$routes = include __DIR__.'/../app/routes.php';
//$sc = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

//$response = $sc->get('framework')->handle($request);
//$response->send();

$app = require_once __DIR__.'/../bootstrap/start.php';
$app->run($request);
