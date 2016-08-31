<?php

namespace app\models;

use app\models\query\DepartmentQuery;
use app\models\query\PerformerQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "performer".
 *
 * @property integer $id
 * @property integer $department_id
 *
 * @property Department[] $departments
 * @property Department $department
 * @property User $user
 */
class Performer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'performer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id'], 'required'],
            [['department_id'], 'integer'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_id' => Yii::t('app', 'Department ID'),
        ];
    }

    /**
     * @return DepartmentQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['chief_id' => 'id'])->inverseOf('chief');
    }

    /**
     * @return DepartmentQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id'])->inverseOf('performers');
    }

    /**
     * @return UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id'])->inverseOf('performer');
    }

    /**
     * @inheritdoc
     * @return PerformerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerformerQuery(get_called_class());
    }
}
