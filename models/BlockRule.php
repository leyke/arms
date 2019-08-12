<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block_rule".
 *
 * @property int $id
 * @property int $condition
 * @property int $action
 * @property int $alternative_action
 * @property int $rule
 * @property int $call_mode
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Action $action0
 * @property Action $action1
 * @property Condition $condition0
 * @property RefData $callMode
 * @property Rule $rule0
 * @property User $updu0
 */
class BlockRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'block_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['condition', 'action', 'alternative_action', 'rule', 'call_mode', 'updu', 'ver'], 'default', 'value' => null],
            [['condition', 'action', 'alternative_action', 'rule', 'call_mode', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
            [['action'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action' => 'id']],
            [['action'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action' => 'id']],
            [['condition'], 'exist', 'skipOnError' => true, 'targetClass' => Condition::className(), 'targetAttribute' => ['condition' => 'id']],
            [['call_mode'], 'exist', 'skipOnError' => true, 'targetClass' => RefData::className(), 'targetAttribute' => ['call_mode' => 'id']],
            [['rule'], 'exist', 'skipOnError' => true, 'targetClass' => Rule::className(), 'targetAttribute' => ['rule' => 'id']],
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
            'condition' => 'Condition',
            'action' => 'Action',
            'alternative_action' => 'Alternative Action',
            'rule' => 'Rule',
            'call_mode' => 'Call Mode',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction0()
    {
        return $this->hasOne(Action::className(), ['id' => 'action']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction1()
    {
        return $this->hasOne(Action::className(), ['id' => 'action']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondition0()
    {
        return $this->hasOne(Condition::className(), ['id' => 'condition']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallMode()
    {
        return $this->hasOne(RefData::className(), ['id' => 'call_mode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule0()
    {
        return $this->hasOne(Rule::className(), ['id' => 'rule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }
}
