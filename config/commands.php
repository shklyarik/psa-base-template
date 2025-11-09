<?php

return [
'help'  => Psa\Core\Cli\Commands\HelpCommand::class,
    'add'   => App\Commands\AddCommand::class,
    'inbox' => App\Commands\InboxCommand::class,
    'done'  => App\Commands\DoneCommand::class,

    ... Psa\Core\Cli\Commands\Generate\CommandRegistry::Commands,
    ... Psa\Migration\Cli\CommandRegistry::Commands,
    'process' => App\Commands\ProcessCommand::class,
];

