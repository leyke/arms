<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_data".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $updu
 * @property int $group
 * @property string $updt
 * @property int $ver
 *
 * @property BlockRule[] $blockRules
 * @property Component[] $components
 * @property Direction[] $directions
 * @property Event[] $events
 * @property FieldMarker[] $fieldMarkers
 * @property RefGroup $group0
 * @property User $updu0
 * @property Rule[] $rules
 * @property Rule[] $rules0
 * @property Rule[] $rules1
 */
class RefData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['updu', 'group', 'ver'], 'default', 'value' => null],
            [['updu', 'group', 'ver'], 'integer'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['group'], 'exist', 'skipOnError' => true, 'targetClass' => RefGroup::className(), 'targetAttribute' => ['group' => 'id']],
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
            'group' => 'Group',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockRules()
    {
        return $this->hasMany(BlockRule::className(), ['call_mode' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponents()
    {
        return $this->hasMany(Component::className(), ['type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldMarkers()
    {
        return $this->hasMany(FieldMarker::className(), ['type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup0()
    {
        return $this->hasOne(RefGroup::className(), ['id' => 'group']);
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
        return $this->hasMany(Rule::className(), ['linking_mode' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules0()
    {
        return $this->hasMany(Rule::className(), ['type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules1()
    {
        return $this->hasMany(Rule::className(), ['state' => 'id']);
    }
}
