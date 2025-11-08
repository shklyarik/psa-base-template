<?php

namespace App\Commands;

use Psa\CliKit\InputField;
use Psa\Qb\Db;

class AddCommand
{
    public function run(Db $db)
    {
        $name = new InputField('📝 New task name: ')->value();

        $db->from('tasks')->insert([
            'name' => $name,
        ]);
    }
}
