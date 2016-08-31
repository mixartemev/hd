<?php

use console\models\Migrate;

class m160805_072336_action extends Migrate
{
    public function up()
    {
        $this->createTable('{{%action}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'action_type' => $this->tinyInt(),
            'val_id' => $this->integer(),
            'when' => $this->integer(),
            'initiator_id' => $this->integer(),
        ]);
        $this->addForeignKey('task', '{{%action}}', 'task_id', '{{%task}}', 'id');
        //$this->addForeignKey('val', '{{%action}}', 'val_id', '{{%task}}', 'id');
        $this->addForeignKey('initiator', '{{%action}}', 'initiator_id', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%action}}');
    }
}