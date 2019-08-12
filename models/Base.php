<?php

namespace app\models;

use Yii;

/**
 * Created by PhpStorm.
 * User: PC
 * Date: 26.05.2019
 * Time: 11:36
 */

/**
 * @property int $updu
 * @property string $updt
 * @property int $ver
 */

class Base extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {

        if (!Yii::$app->user->isGuest) {
            $this->updu = Yii::$app->user->id;
            $this->updt = date("Y-m-d H:i:s");
            $this->ver = (empty($this->ver)) ? 1 : $this->ver + 1;
        }
        return parent::beforeSave($insert);
    }
}