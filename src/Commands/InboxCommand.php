<?php

namespace App\Commands;

use Psa\Qb\Db;

class InboxCommand
{
    public function run(Db $db)
    {
        $tasks = $db->from('tasks')
            ->select('name')
            ->where(['is_deleted' => 0, 'is_done' => 0, 'category_id' => null])
            ->all();

        foreach ($tasks as $task) {
            echo " \033[34m➤\033[0m " . $task['name'] . PHP_EOL;
        }
    }
}
