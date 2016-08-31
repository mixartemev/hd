<?php

namespace app\models;

use app\models\query\DepartmentQuery;
use app\models\query\PerformerQuery;
use app\models\query\TaskTypeQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "department".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $chief_id
 *
 * @property Performer $chief
 * @property Department $parent
 * @property Department[] $departments
 * @property Performer[] $performers
 * @property TaskType[] $taskTypes
 */
class Department extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'chief_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['chief_id'], 'exist', 'skipOnError' => true, 'targetClass' => Performer::className(), 'targetAttribute' => ['chief_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'chief_id' => Yii::t('app', 'Chief ID'),
        ];
    }

    /**
     * @return PerformerQuery
     */
    public function getChief()
    {
        return $this->hasOne(Performer::className(), ['id' => 'chief_id'])->inverseOf('departments');
    }

    /**
     * @return DepartmentQuery
     */
    public function getParent()
    {
        return $this->hasOne(Department::className(), ['id' => 'parent_id'])->inverseOf('departments');
    }

    /**
     * @return DepartmentQuery child
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * @return PerformerQuery
     */
    public function getPerformers()
    {
        return $this->hasMany(Performer::className(), ['department_id' => 'id'])->inverseOf('department');
    }

    /**
     * @return TaskTypeQuery
     */
    public function getTaskTypes()
    {
        return $this->hasMany(TaskType::className(), ['department_id' => 'id'])->inverseOf('department');
    }

    /**
     * @inheritdoc
     * @return DepartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartmentQuery(get_called_class());
    }
}
