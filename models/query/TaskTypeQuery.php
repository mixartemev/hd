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
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaskType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaskType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
