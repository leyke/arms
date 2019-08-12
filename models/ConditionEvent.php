<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "condition_event".
 *
 * @property int $id
 * @property string $script
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property User $updu0
 * @property Event[] $events
 */
class ConditionEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'condition_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['script'], 'string'],
            [['updu', 'ver'], 'default', 'value' => null],
            [['updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
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
            'script' => 'Script',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
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
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['condition' => 'id']);
    }
}
