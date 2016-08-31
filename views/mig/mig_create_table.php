<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */

$name = substr( strrchr($className, '_'), 1);

echo "<?php\n";
?>

use app\models\Migrate;

class <?= $className ?> extends Migrate
{
    public function up()
    {
        $this->createTable('{{%<?=$name?>}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('parent_<?=$name?>', '{{%<?=$name?>}}', 'parent_id', '{{%<?=$name?>}}', 'id');
}

    public function down()
    {
        $this->dropTable('{{%<?=$name?>}}');
    }
}