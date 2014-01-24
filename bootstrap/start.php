<?php

$routes = require_once __DIR__.'/../app/routes.php';
$app = new Solum\Application($routes);

return $app;
