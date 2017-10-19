<?php

namespace app\models\base;

use app\models\Action;
use app\models\Performer;
use app\models\query\PerformerQuery;
use app\models\User;
use app\models\query\ActionQuery;
use app\models\query\TaskQuery;
use app\models\query\TaskTypeQuery;
use app\models\query\UserQuery;
use app\models\TaskType;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the base-model class for table "task".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $customer_id
 * @property integer $task_type_id
 *
 * @property Action[] $actions
 * @property TaskType $taskType
 * @property User $customer
 * @property Task $parent
 * @property Task[] $tasks
 */
class Task extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id', 'customer_id', 'task_type_id'], 'required'],
            [['parent_id', 'customer_id', 'task_type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
	        [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
	        [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['parent_id' => 'id']],
	        [['task_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['task_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'task_type_id' => Yii::t('app', 'Task Type ID'),
        ];
    }

    /**
     * @return ActionQuery | ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['task_id' => 'id'])->inverseOf('task');
    }

    /**
     * @return UserQuery | ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id'])->inverseOf('tasks');
    }

    /**
     * @return PerformerQuery | ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(Performer::className(), ['id' => 'customer_id'])->inverseOf('tasks'); //todo Как найти исполнителя из Actions
    }

    /**
     * @return TaskQuery | ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Task::className(), ['id' => 'parent_id'])->inverseOf('tasks');
    }

    /**
     * @return TaskQuery | ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * @return TaskTypeQuery | ActiveQuery
     */
    public function getTaskType()
    {
        return $this->hasOne(TaskType::className(), ['id' => 'task_type_id'])->inverseOf('tasks');
    }

    /**
     * @inheritdoc
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
