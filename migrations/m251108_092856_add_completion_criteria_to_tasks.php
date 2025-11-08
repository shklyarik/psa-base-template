<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        $this->addColumn('tasks', 'completion_criteria', $this->text()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('tasks', 'completion_criteria');
    }
};
