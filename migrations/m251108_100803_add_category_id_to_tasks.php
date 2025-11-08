<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        // Add category_id column to tasks table
        $this->addColumn('tasks', 'category_id', $this->integer()->defaultValue(null));
        
        // Add foreign key constraint
        $this->addForeignKey('fk_tasks_category_id', 'tasks', 'category_id', 'categories', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key constraint first
        $this->dropForeignKey('fk_tasks_category_id', 'tasks');
        
        // Drop the column
        $this->dropColumn('tasks', 'category_id');
    }
};
