<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../.env.php';

new Psa\Core\Web\App(
    di: new Psa\Core\Common\Container(require_once __DIR__ . '/../src/Config/web.php'),
    router: new Psa\Core\Web\Router(require_once __DIR__ . '/../src/Config/routes.php')
)->run();