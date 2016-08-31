<?php
/**
 * User: mix
 * Date: 04/08/16
 * Time: 00:27
 */

namespace app\commands;

use yii\console\controllers\MigrateController;

class MigController extends MigrateController
{
	/**
	 * @inheritdoc
	 */
	public $templateFile = '@views/migration.php';
}
