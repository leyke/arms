<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Package $parent0
 * @property Package[] $packages
 * @property User $updu0
 * @property Rule[] $rules
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'package';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'updu', 'ver'], 'default', 'value' => null],
            [['parent', 'updu', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Package::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'parent' => 'Parent',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Package::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasMany(Package::className(), ['parent' => 'id']);
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
    public function getRules()
    {
        return $this->hasMany(Rule::className(), ['package' => 'id']);
    }
}
