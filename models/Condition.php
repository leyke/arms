<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "condition".
 *
 * @property int $id
 * @property string $script
 * @property int $context
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property BlockRule[] $blockRules
 * @property Context $context0
 * @property User $updu0
 */
class Condition extends Base
{
    const DATA_TYPE = 'condition';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'condition';
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
    public function getBlockRules()
    {
        return $this->hasMany(BlockRule::className(), ['condition' => 'id']);
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
}
