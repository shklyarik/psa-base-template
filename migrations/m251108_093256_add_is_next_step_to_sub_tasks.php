<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->addColumn('sub_tasks', 'is_next_step', $this->boolean()->defaultValue(0)->notNull());
    }

    public function down()
    {
        $this->dropColumn('sub_tasks', 'is_next_step');
    }
};
