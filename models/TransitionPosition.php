<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transition_position".
 *
 * @property int $id
 * @property int $direction
 * @property int $marker
 * @property int $position
 * @property int $transition
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Direction $direction0
 * @property Marker $marker0
 * @property Position $position0
 * @property Transition $transition0
 * @property User $updu0
 */
class TransitionPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transition_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['direction', 'marker', 'position', 'transition', 'updu', 'ver'], 'default', 'value' => null],
            [['direction', 'marker', 'position', 'transition', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
            [['direction'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction' => 'id']],
            [['marker'], 'exist', 'skipOnError' => true, 'targetClass' => Marker::className(), 'targetAttribute' => ['marker' => 'id']],
            [['position'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position' => 'id']],
            [['transition'], 'exist', 'skipOnError' => true, 'targetClass' => Transition::className(), 'targetAttribute' => ['transition' => 'id']],
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
            'direction' => 'Direction',
            'marker' => 'Marker',
            'position' => 'Position',
            'transition' => 'Transition',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirection0()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarker0()
    {
        return $this->hasOne(Marker::className(), ['id' => 'marker']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition0()
    {
        return $this->hasOne(Position::className(), ['id' => 'position']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransition0()
    {
        return $this->hasOne(Transition::className(), ['id' => 'transition']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }
}
