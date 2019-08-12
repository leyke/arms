<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property int $condition
 * @property int $context
 * @property int $complex_event
 * @property int $source
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property ComplexEvent[] $complexEvents
 * @property ComplexEvent $complexEvent
 * @property Component $source0
 * @property ConditionEvent $condition0
 * @property Context $context0
 * @property RefData $type0
 * @property User $updu0
 * @property Rule[] $rules
 */
class Event extends Base
{
    const LABEL = 'События';
    const DATA_TYPE = 'event';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'condition', 'context', 'complex_event', 'source', 'updu', 'ver'], 'default', 'value' => null],
            [['type', 'condition', 'context', 'complex_event', 'source', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['complex_event'], 'exist', 'skipOnError' => true, 'targetClass' => ComplexEvent::className(), 'targetAttribute' => ['complex_event' => 'id']],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['source' => 'id']],
            [['condition'], 'exist', 'skipOnError' => true, 'targetClass' => ConditionEvent::className(), 'targetAttribute' => ['condition' => 'id']],
            [['context'], 'exist', 'skipOnError' => true, 'targetClass' => Context::className(), 'targetAttribute' => ['context' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => RefData::className(), 'targetAttribute' => ['type' => 'id']],
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
            'name' => 'Name',
            'type' => 'Type',
            'condition' => 'Condition',
            'context' => 'Context',
            'complex_event' => 'Complex Event',
            'source' => 'Source',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexEvents()
    {
        return $this->hasMany(ComplexEvent::className(), ['initiator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexEvent()
    {
        return $this->hasOne(ComplexEvent::className(), ['id' => 'complex_event']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(Component::className(), ['id' => 'source']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondition0()
    {
        return $this->hasOne(ConditionEvent::className(), ['id' => 'condition']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContext0()
    {
        return $this->hasOne(Context::className(), ['id' => 'context']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(RefData::className(), ['id' => 'type']);
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
    public function getRules()
    {
        return $this->hasMany(Rule::className(), ['event' => 'id']);
    }
}
