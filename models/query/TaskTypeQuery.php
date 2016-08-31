<?php

namespace app\models\query;
use app\models\TaskType;

/**
 * This is the ActiveQuery class for [[TaskType]].
 *
 * @see TaskType
 */
class TaskTypeQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return TaskType[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaskType|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
