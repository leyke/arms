<?php

namespace app\models;


use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "user_e".
 *
 * @property int $id
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property string $password write-only password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 *
 * @property Action[] $actions
 * @property Application[] $applications
 * @property BlockRule[] $blockRules
 * @property Component[] $components
 * @property Condition[] $conditions
 * @property ConditionEvent[] $conditionEvents
 * @property Context[] $contexts
 * @property Direction[] $directions
 * @property Event[] $events
 * @property FieldMarker[] $fieldMarkers
 * @property Marker[] $markers
 * @property Package[] $packages
 * @property Position[] $positions
 * @property RefData[] $refDatas
 * @property RefGroup[] $refGroups
 * @property Role[] $roles
 * @property Rule[] $rules
 * @property Transition[] $transitions
 * @property TransitionPosition[] $transitionPositions
 * @property User $updu0
 * @property User[] $users
 * @property UserRole[] $userRoles
 * @property UserRole[] $userRoles0
 *
 * @property array $rolesBuf
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const NAME = "Пользователь";
    const ONE_NAME = "пользователя";

    public $password;
    public $authKey;
    public $accessToken;

    public $new_password;

    public $rolesBuf;

    public static function tableName()
    {
        return 'user_e';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['updu', 'ver'], 'default', 'value' => null],
            [['updu', 'ver'], 'integer'],
            [['updt', 'rolesBuf'], 'safe'],
            [
                [
                    'name',
                    'first_name',
                    'last_name',
                    'login',
                    'email',
                    'phone',
                    '!password_hash',
                    '!password_reset_token',
                    'new_password'
                ],
                'string',
                'max' => 255
            ],
            ['!auth_key', 'string', 'max' => 32],
            [['description'], 'string', 'max' => 1024],
            [
                ['updu'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['updu' => 'id']
            ],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->generateAuthKey();
            $this->setPassword($this->new_password);
        } else {
            if (strlen($this->new_password)) {
                $this->setPassword($this->new_password);
            }
        }

        if (!Yii::$app->user->isGuest) {
            $this->updu = Yii::$app->user->id;
            $this->updt = date("Y-m-d H:i:s");
            $this->ver = (empty($this->ver)) ? 1 : $this->ver + 1;
        }

        return parent::beforeSave($insert);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|\yii\web\IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockRules()
    {
        return $this->hasMany(BlockRule::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponents()
    {
        return $this->hasMany(Component::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditions()
    {
        return $this->hasMany(Condition::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionEvents()
    {
        return $this->hasMany(ConditionEvent::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContexts()
    {
        return $this->hasMany(Context::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldMarkers()
    {
        return $this->hasMany(FieldMarker::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkers()
    {
        return $this->hasMany(Marker::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasMany(Package::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefDatas()
    {
        return $this->hasMany(RefData::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefGroups()
    {
        return $this->hasMany(RefGroup::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(Rule::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransitions()
    {
        return $this->hasMany(Transition::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransitionPositions()
    {
        return $this->hasMany(TransitionPosition::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['updu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['user_e' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles0()
    {
        return $this->hasMany(UserRole::className(), ['updu' => 'id']);
    }
}
