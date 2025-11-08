<?php

return [
    '/' => App\Actions\HomePageAction::class,
    '*' => Psa\Core\Web\Actions\RouteNotFoundAction::class,
];