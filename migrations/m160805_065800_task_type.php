<?php

use app\models\Migrate;

class m160805_065800_task_type extends Migrate
{
    public function up()
    {
        $this->createTable('{{%task_type}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'department_id' => $this->integer()->null(),
            'sla' => $this->integer()->null(),
        ]);
        $this->addForeignKey('parent_type', '{{%task_type}}', 'parent_id', '{{%task_type}}', 'id');
        $this->addForeignKey('default_department', '{{%task_type}}', 'department_id', '{{%department}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%task_type}}');
    }
}