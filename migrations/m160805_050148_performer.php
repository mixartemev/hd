<?php

use console\models\Migrate;

class m160805_050148_performer extends Migrate
{
    public function up()
    {
        $this->createTable('{{%performer}}', [
            'user_id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('user', '{{%performer}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('department', '{{%performer}}', 'department_id', '{{%department}}', 'id');
        $this->addForeignKey('chief', '{{%department}}', 'chief_id', '{{%performer}}', 'id');

    }

    public function down()
    {
        $this->dropForeignKey('chief', '{{%department}}');
        $this->dropTable('{{%performer}}');
    }
}