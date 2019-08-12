<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property int $type
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property RefData $type0
 * @property User $updu0
 * @property TransitionPosition[] $transitionPositions
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'updu', 'ver'], 'default', 'value' => null],
            [['type', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
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
            'type' => 'Type',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
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
    public function getTransitionPositions()
    {
        return $this->hasMany(TransitionPosition::className(), ['direction' => 'id']);
    }
}
