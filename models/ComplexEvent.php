<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complex_event".
 *
 * @property int $id
 * @property int $initiator
 * @property string $expression
 * @property int $time_limit
 *
 * @property Event $initiator0
 * @property Event[] $events
 */
class ComplexEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complex_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['initiator', 'time_limit'], 'default', 'value' => null],
            [['initiator', 'time_limit'], 'integer'],
            [['expression'], 'string'],
            [['initiator'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['initiator' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'initiator' => 'Initiator',
            'expression' => 'Expression',
            'time_limit' => 'Time Limit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitiator0()
    {
        return $this->hasOne(Event::className(), ['id' => 'initiator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['complex_event' => 'id']);
    }
}
