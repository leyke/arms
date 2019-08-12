<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_marker".
 *
 * @property int $id
 * @property string $description
 * @property string $value
 * @property int $type
 * @property int $marker
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Marker $marker0
 * @property RefData $type0
 * @property User $updu0
 */
class FieldMarker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'field_marker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['type', 'marker', 'updu', 'ver'], 'default', 'value' => null],
            [['type', 'marker', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
            [['marker'], 'exist', 'skipOnError' => true, 'targetClass' => Marker::className(), 'targetAttribute' => ['marker' => 'id']],
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
            'description' => 'Description',
            'value' => 'Value',
            'type' => 'Type',
            'marker' => 'Marker',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
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
}
