<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property int $id
 * @property string $name
 * @property int $package
 * @property int $linking_mode
 * @property int $type
 * @property int $state
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property BlockRule[] $blockRules
 * @property Event[] $event
 * @property Package $package0
 * @property RefData $linkingMode
 * @property RefData $type0
 * @property RefData $state0
 * @property User $updu0
 */
class Rule extends Base
{
    const LABEL = 'Активные правила';
    const NAME = 'Правило';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['package', 'linking_mode', 'type', 'state', 'updu', 'ver', 'event'], 'default', 'value' => null],
            [['package', 'linking_mode', 'type', 'state', 'updu', 'ver', 'event'], 'integer'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [
                ['event'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Event::className(),
                'targetAttribute' => ['event' => 'id']
            ],
            [
                ['package'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Package::className(),
                'targetAttribute' => ['package' => 'id']
            ],
            [
                ['linking_mode'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RefData::className(),
                'targetAttribute' => ['linking_mode' => 'id']
            ],
            [
                ['type'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RefData::className(),
                'targetAttribute' => ['type' => 'id']
            ],
            [
                ['state'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RefData::className(),
                'targetAttribute' => ['state' => 'id']
            ],
            [
                ['updu'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['updu' => 'id']
            ],
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
            'package' => 'Package',
            'linking_mode' => 'Linking Mode',
            'type' => 'Type',
            'state' => 'State',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockRules()
    {
        return $this->hasMany(BlockRule::className(), ['rule' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['rule' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage0()
    {
        return $this->hasOne(Package::className(), ['id' => 'package']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkingMode()
    {
        return $this->hasOne(RefData::className(), ['id' => 'linking_mode']);
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
    public function getState0()
    {
        return $this->hasOne(RefData::className(), ['id' => 'state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }
}
