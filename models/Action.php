<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id
 * @property string $script
 * @property int $context
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Context $context0
 * @property User $updu0
 * @property BlockRule[] $blockRules
 * @property BlockRule[] $blockRules0
 */
class Action extends Base
{
    const LABEL = 'Действия';
    const DATA_TYPE = 'action';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['script'], 'string'],
            [['context', 'updu', 'ver'], 'default', 'value' => null],
            [['context', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['description'], 'string', 'max' => 1024],
            [['context'], 'exist', 'skipOnError' => true, 'targetClass' => Context::className(), 'targetAttribute' => ['context' => 'id']],
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
            'context' => 'Context',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
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
    public function getUpdu0()
    {
        return $this->hasOne(User::className(), ['id' => 'updu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockRules()
    {
        return $this->hasMany(BlockRule::className(), ['action' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockRules0()
    {
        return $this->hasMany(BlockRule::className(), ['action' => 'id']);
    }
}
