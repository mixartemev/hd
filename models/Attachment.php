<?php

namespace app\models;

use app\models\query\ActionQuery;
use app\models\query\AttachmentQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "attachment".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $name
 *
 * @property Action $action
 */
class Attachment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'name'], 'required'],
            [['action_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return ActionQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action_id'])->inverseOf('attachments');
    }

    /**
     * @inheritdoc
     * @return AttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttachmentQuery(get_called_class());
    }
}
