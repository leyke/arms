<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "component".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property int $application
 * @property int $type
 * @property string $xml_properties
 * @property string $description
 * @property int $updu
 * @property string $updt
 * @property int $ver
 *
 * @property Application $application0
 * @property Component $parent0
 * @property Component[] $components
 * @property RefData $type0
 * @property User $updu0
 * @property Event[] $events
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'application', 'type', 'updu', 'ver'], 'default', 'value' => null],
            [['parent', 'application', 'type', 'updu', 'ver'], 'integer'],
            [['xml_properties'], 'string'],
            [['updt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['application'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application' => 'id']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'name' => 'Name',
            'parent' => 'Parent',
            'application' => 'Application',
            'type' => 'Type',
            'xml_properties' => 'Xml Properties',
            'description' => 'Description',
            'updu' => 'Updu',
            'updt' => 'Updt',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication0()
    {
        return $this->hasOne(Application::className(), ['id' => 'application']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Component::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponents()
    {
        return $this->hasMany(Component::className(), ['parent' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['source' => 'id']);
    }
}
