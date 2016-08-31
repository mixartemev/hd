<?php

namespace app\models\query;
use app\models\User;

/**
 * This is the ActiveQuery class for [[User]].
 *
 * @see User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    public function active($minStatus = 2)
    {
        return $this->andWhere(['>=', '[[status]]', $minStatus]);
    }

    /**
     * @inheritdoc
     * @return User[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
