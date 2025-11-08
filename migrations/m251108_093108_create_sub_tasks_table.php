<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->createTable('sub_tasks', [
            'id'           => $this->primaryKey(),
            'name'         => $this->string(500)->notNull(),
            'task_id'      => $this->integer()->notNull(),
            'is_deleted'   => $this->boolean()->defaultValue(0)->notNull(),
            'is_done'      => $this->boolean()->defaultValue(0)->notNull(),
        ]);
        
        $this->addForeignKey('fk_sub_tasks_task_id', 'sub_tasks', 'task_id', 'tasks', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_sub_tasks_task_id', 'sub_tasks');
        $this->dropTable('sub_tasks');
    }
};
