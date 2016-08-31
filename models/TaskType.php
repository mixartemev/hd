<?php

namespace app\models;

use app\models\query\DepartmentQuery;
use app\models\query\TaskQuery;
use app\models\query\TaskTypeQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task_type".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $department_id
 * @property integer $sla
 *
 * @property Task[] $tasks
 * @property Department $department
 * @property TaskType $parent
 * @property TaskType[] $taskTypes
 */
class TaskType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name'], 'required'],
            [['parent_id', 'department_id', 'sla'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskType::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'department_id' => Yii::t('app', 'Department ID'),
            'sla' => Yii::t('app', 'Sla'),
        ];
    }

    /**
     * @return TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['task_type_id' => 'id'])->inverseOf('taskType');
    }

    /**
     * @return DepartmentQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id'])->inverseOf('taskTypes');
    }

    /**
     * @return TaskTypeQuery
     */
    public function getParent()
    {
        return $this->hasOne(TaskType::className(), ['id' => 'parent_id'])->inverseOf('taskTypes');
    }

    /**
     * @return TaskTypeQuery child
     */
    public function getTaskTypes()
    {
        return $this->hasMany(TaskType::className(), ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * @inheritdoc
     * @return TaskTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskTypeQuery(get_called_class());
    }
}
