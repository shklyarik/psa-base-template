<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->addColumn('tasks', 'is_done', $this->boolean()->defaultValue(0)->notNull());
    }

    public function down()
    {
        $this->dropColumn('tasks', 'is_done');
    }
};
