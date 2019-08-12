<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_group".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property RefData[] $refDatas
 * @property User $updu0
 */
class RefGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_group';
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
    public function getRefDatas()
    {
        return $this->hasMany(RefData::className(), ['group' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }
}
