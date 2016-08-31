<?php

namespace app\models\query;

use app\models\Comment;

/**
 * This is the ActiveQuery class for [[Comment]].
 *
 * @see Comment
 */
class CommentQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Comment[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Comment|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
