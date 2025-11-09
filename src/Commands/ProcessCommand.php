<?php

namespace App\Commands;

use Psa\Qb\Db;
use Psa\CliKit\Select;

class ProcessCommand
{
    public function run(Db $db)
    {
        $tasks = $db->from('tasks')
            ->select('name')
            ->where(['is_deleted' => 0, 'is_done' => 0, 'category_id' => null])
            ->one();


        $need_do = new Select(['Yes', 'No'], 'Мне нужно с этим что то делать?')->value();
        if ($need_do === 'Yes') {
            $do_self = new Select(['Yes', 'No'], 'Это должен делать я?')->value();
            if ($do_self == 'Yes') {
                echo "Теперь нужно понять когда это делать)" . PHP_EOL;
            } else {
                echo "Не нужно делегировать" . PHP_EOL;
            }
        } else {
            echo "Не нужно делать" . PHP_EOL;
        }
    }
}
