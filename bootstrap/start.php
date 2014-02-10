<?php

require_once __DIR__.'/../app/config/app.php';

$app = new Solum\Application;
require_once __DIR__.'/../app/routes.php';

return $app;
