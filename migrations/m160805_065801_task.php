<?php

use app\models\Migrate;

class m160805_065801_task extends Migrate
{
    public function up()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'task_type_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('parent_task', '{{%task}}', 'parent_id', '{{%task}}', 'id');
        $this->addForeignKey('customer', '{{%task}}', 'customer_id', '{{%user}}', 'id');
        $this->addForeignKey('task_type', '{{%task}}', 'task_type_id', '{{%task_type}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%task}}');
    }
}
