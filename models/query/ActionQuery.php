<?php

namespace app\models\query;

use app\models\Action;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Action]].
 *
 * @see Action
 */
class ActionQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Action[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Action|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
