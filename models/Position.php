<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property User $updu0
 * @property TransitionPosition[] $transitionPositions
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['updu', 'ver'], 'default', 'value' => null],
            [['updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
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
    public function getTransitionPositions()
    {
        return $this->hasMany(TransitionPosition::className(), ['position' => 'id']);
    }
}
