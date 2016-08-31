<?php

use yii\db\Migration;

class m160824_131232_users_input extends Migration
{
    public function up()
    {
        $this->insert('user',[
            'id' => 1,
            'username' => 'admin',
            'name' => 'О Всевышний!',
            'auth_key' => 'h1YGPWD1n7QIyFOiItlRbUwL1An1XQgv',
            'password_hash' => '$2y$13$ycwvwtyp7tP7xAVLE0laNeuFs3IvgNyk7RbzAyCR8g/Qcy8iGdaA6',
            'email' => 'mixartemev@gmail.com',
            //'phone' => null,
            'status' => 3,
            'created_at' => 1471271180,
            'updated_at' => 1471679830,
        ]);
        $this->insert('user',[
            'id' => 2,
            'username' => 'artemiev',
            'name' => 'Михаил Артемьев',
            'auth_key' => 'h1YfPWD1n7QIyFOiItlRbUwL1AnRrt',
            'password_hash' => '$2y$13$ycwvwtyp7tP7xAVLE0laNeuFs3IvgNyk7RbzAyCR8g/Qcy8iGdaA6',
            'email' => 'm.artemev@igr.ru',
            'phone' => 441,
            'status' => 2,
            'created_at' => 1471271187,
            'updated_at' => 1471679832,
        ]);
    }

    public function down()
    {
        $this->delete('user', ['username' => 'admin']);
        $this->delete('user', 2);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
