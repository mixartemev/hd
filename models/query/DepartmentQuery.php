<?php

namespace app\models\query;

use app\models\Department;

/**
 * This is the ActiveQuery class for [[Department]].
 *
 * @see Department
 */
class DepartmentQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Department[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Department|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
