<?php

use Psa\Migration\Migration;

return new class extends Migration
{
    public function up()
    {
        // Create categories table
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(500)->defaultValue(null),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);

        // Insert initial categories
        $this->insert('categories', [
            'name' => 'Note',
            'description' => 'Notes and observations',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('categories', [
            'name' => 'Idea',
            'description' => 'Ideas and thoughts to explore',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('categories', [
            'name' => 'Delegation',
            'description' => 'Tasks delegated to others',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('categories', [
            'name' => 'Todo',
            'description' => 'Tasks to be done',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('categories', [
            'name' => 'Backlog',
            'description' => 'Tasks for future consideration',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->insert('categories', [
            'name' => 'Waiting',
            'description' => 'Tasks waiting on external factors',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->dropTable('categories');
    }
};
