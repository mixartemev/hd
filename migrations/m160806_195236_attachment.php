<?php

use console\models\Migrate;

class m160806_195236_attachment extends Migrate
{
    public function up()
    {
        $this->createTable('{{%attachment}}', [
            'id' => $this->primaryKey(),
            'action_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('action_attachment', '{{%attachment}}', 'action_id', '{{%action}}', 'id');
}

    public function down()
    {
        $this->dropTable('{{%attachment}}');
    }
}