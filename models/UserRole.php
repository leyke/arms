<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_role".
 *
 * @property int $id
 * @property string $description
 * @property int $application
 * @property int $user_e
 * @property int $role
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Application $application0
 * @property Role $role0
 * @property User $User
 * @property User $updu0
 */
class UserRole extends Base
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application', 'user_e', 'role', 'updu', 'ver'], 'default', 'value' => null],
            [['application', 'user_e', 'role', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
            [['application'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application' => 'id']],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role' => 'id']],
            [['user_e'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_e' => 'id']],
            [['updu'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updu' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'application' => 'Application',
            'user_e' => 'User E',
            'role' => 'Role',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication0()
    {
        return $this->hasOne(Application::className(), ['id' => 'application']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Role::className(), ['id' => 'role']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_e']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }
}
