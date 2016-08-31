<?php

namespace app\models;

use app\models\query\ActionQuery;
use app\models\query\CommentQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $content
 *
 * @property Action $action
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'content'], 'required'],
            [['action_id'], 'integer'],
            [['content'], 'string', 'max' => 255],
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
            'content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @return ActionQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action_id'])->inverseOf('comments');
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
