<?php

namespace app\models\base;

use app\models\Action;
use app\models\Performer;
use app\models\query\ActionQuery;
use app\models\query\PerformerQuery;
use app\models\query\TaskQuery;
use app\models\Task;
use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\query\UserQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $phone
 * @property string $confirm_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Action[] $actions
 * @property Performer $performer
 * @property Task[] $tasks
 */
abstract class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['phone', 'status'], 'integer'],
            [['username', 'name', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key', 'confirm_token'], 'string', 'max' => 43],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'confirm_token' => Yii::t('app', 'Confirm Token'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return ActionQuery | ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany( Action::className(), [ 'initiator_id' => 'id'])->inverseOf('initiator');
    }

    /**
     * @return PerformerQuery | ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne( Performer::className(), [ 'id' => 'id'])->inverseOf('id0');
    }

    /**
     * @return TaskQuery | ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany( Task::className(), [ 'customer_id' => 'id'])->inverseOf('customer');
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
