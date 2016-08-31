<?php

namespace app\models;

use app\models\query\ActionQuery;
use app\models\query\AttachmentQuery;
use app\models\query\CommentQuery;
use app\models\query\TaskQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "action".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $action_type
 * @property integer $val_id
 * @property integer $when
 * @property integer $initiator_id
 *
 * @property User $initiator
 * @property Task $task
 * @property Attachment[] $attachments
 * @property Comment[] $comments
 */
class Action extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id'], 'required'],
            [['task_id', 'action_type', 'val_id', 'when', 'initiator_id'], 'integer'],
            [['initiator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['initiator_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'action_type' => Yii::t('app', 'Action Type'),
            'val_id' => Yii::t('app', 'Val ID'),
            'when' => Yii::t('app', 'When'),
            'initiator_id' => Yii::t('app', 'Initiator ID'),
        ];
    }

    /**
     * @return UserQuery
     */
    public function getInitiator()
    {
        return $this->hasOne(User::className(), ['id' => 'initiator_id'])->inverseOf('actions');
    }

    /**
     * @return TaskQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id'])->inverseOf('actions');
    }

    /**
     * @return AttachmentQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['action_id' => 'id'])->inverseOf('action');
    }

    /**
     * @return CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['action_id' => 'id'])->inverseOf('action');
    }

    /**
     * @inheritdoc
     * @return ActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActionQuery(get_called_class());
    }
}
