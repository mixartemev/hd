<?php

namespace app\models\query;

use app\models\Attachment;

/**
 * This is the ActiveQuery class for [[Attachment]].
 *
 * @see Attachment
 */
class AttachmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Attachment[]|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Attachment|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
