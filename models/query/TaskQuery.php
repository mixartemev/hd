<?php

namespace app\models\query;
use app\models\Task;

/**
 * This is the ActiveQuery class for [[Task]].
 *
 * @see Task
 */
class TaskQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Task[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Task|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
