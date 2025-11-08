<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->createTable('tasks', [
            'id'           => $this->primaryKey(),
            'name'         => $this->string(500)->notNull(),
            'is_deleted'   => $this->boolean()->defaultValue(0)->notNull(),
            'completed_at' => $this->datetime()->defaultValue(null),
        ]);
    }

    public function down()
    {
        $this->dropTable('tasks');
    }
};