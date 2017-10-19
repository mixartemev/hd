<?php

use app\models\Migrate;

class m160806_075701_comment extends Migrate
{
    public function up()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'action_id' => $this->integer()->notNull(),
            'content' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('action_comment', '{{%comment}}', 'action_id', '{{%action}}', 'id');
}

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}