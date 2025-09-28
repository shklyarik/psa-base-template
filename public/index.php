<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../.env.php';

new Psa\Core\Web\App(
    alias: [
        '@app' => __DIR__ . '/..',
    ],
    di:      new Psa\Core\Common\Container(require_once __DIR__ . '/../config/web.php'),
    router:  new Psa\Core\Web\Router(require_once __DIR__ . '/../config/routes.php')
)->run();