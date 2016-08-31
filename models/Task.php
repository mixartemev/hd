<?php

namespace app\models;

use app\models\query\ActionQuery;
use app\models\query\TaskQuery;
use app\models\query\TaskTypeQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
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
            [['task_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['task_type_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'task_type_id' => Yii::t('app', 'Task Type ID'),
        ];
    }

    /**
     * @return ActionQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['task_id' => 'id'])->inverseOf('task');
    }

    /**
     * @return TaskTypeQuery
     */
    public function getTaskType()
    {
        return $this->hasOne(TaskType::className(), ['id' => 'task_type_id'])->inverseOf('tasks');
    }

    /**
     * @return UserQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id'])->inverseOf('tasks');
    }

    /*
     * @return PerformerQuery

    public function getPerformer()
    {
        //return $this->hasOne(User::className(), ['id' => 'customer_id'])->inverseOf('tasks'); //todo Как найти исполнителя из Actions
    }*/

    /**
     * @return TaskQuery
     */
    public function getParent()
    {
        return $this->hasOne(Task::className(), ['id' => 'parent_id'])->inverseOf('tasks');
    }

    /**
     * @return TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['parent_id' => 'id'])->inverseOf('parent');
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
