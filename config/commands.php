<?php

return [
    'help' => Psa\Core\Cli\Commands\HelpCommand::class,
    'add'  => App\Commands\AddCommand::class,
    ... Psa\Core\Cli\Commands\Generate\CommandRegistry::Commands,
    ... Psa\Migration\Cli\CommandRegistry::Commands,
];

