<?php

namespace app\models\query;
use app\models\Performer;

/**
 * This is the ActiveQuery class for [[Performer]].
 *
 * @see Performer
 */
class PerformerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Performer[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Performer|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
