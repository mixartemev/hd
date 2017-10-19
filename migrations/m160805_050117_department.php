<?php

use app\models\Migrate;

class m160805_050117_department extends Migrate
{
    public function up()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull()->defaultValue(1),
            'name' => $this->string()->notNull(),
            'chief_id' => $this->integer()->null(),
        ]);
        $this->addForeignKey('parent_department', '{{%department}}', 'parent_id', '{{%department}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%department}}');
    }
}