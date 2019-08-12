<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testing".
 *
 * @property int $id
 * @property string $name
 * @property string $date_on
 * @property string $date_of
 * @property string $events_buf
 * @property int $updu
 * @property string $updt
 * @property int $ver
 * @property int $description
 */
class Testing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_on', 'date_of', 'updt'], 'safe'],
            [['updu', 'ver', 'description'], 'default', 'value' => null],
            [['updu', 'ver', 'description'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['events_buf'], 'string', 'max' => 5000],
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
            'date_on' => 'Date On',
            'date_of' => 'Date Of',
            'events_buf' => 'Events Buf',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
            'description' => 'Description',
        ];
    }
}
