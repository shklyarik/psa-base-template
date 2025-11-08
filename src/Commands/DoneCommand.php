<?php

namespace App\Commands;

use Psa\CliKit\Select;
use Psa\Qb\Db;

class DoneCommand
{
    public function run(Db $db)
    {
        $tasks = $db->from('tasks')
            ->select('id, name')
            ->where(['is_deleted' => 0, 'is_done' => 0])
            ->all();

        $options = [];
        foreach ($tasks as $k => $task) {
            $options[$k] = $task['name'];
        }

        $idx = new Select($options)->index();
        $task = $tasks[$idx];

        if (!empty($task)) {
            $db->from('tasks')->where(['id' => $task['id']])->update([
                'is_done'      => 1,
                'completed_at' => date('Y-m-d H:i:s'),
            ]);
            echo "✅ Task #" . $task['id'] . ' - ' . $task['name'] . ' wash completed' . PHP_EOL;
        }
    }
}
