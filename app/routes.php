<?php

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();

$routes->add('/', new Routing\Route('/', array('_controller' => function() { return new Response('Hello World'); })));
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
	'year' => null,
	'_controller' => 'Acme\\Controller\\LeapYearController::indexAction',
)));
$routes->add('test', new Routing\Route('test', array('_controller' => function() { 
})));

return $routes;
