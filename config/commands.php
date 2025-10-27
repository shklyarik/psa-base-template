<?php

return [
    'help' => Psa\Core\Cli\Commands\HelpCommand::class,
    ... Psa\Core\Cli\Commands\Generate\CommandRegistry::Commands,
    ... Psa\Migration\Cli\CommandRegistry::Commands,
];

