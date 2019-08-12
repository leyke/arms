<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Action */
/* @var $form yii\widgets\ActiveForm */

/* @var $items array */
/* @var $newModelID integer */

?>

<p>Список Действий</p>
<div class="result" data-model-type="<?= \app\models\Action::DATA_TYPE ?>"
     <? if ($newModelID): ?>data-newModelID="<?= $newModelID ?>" <? endif; ?>>
    <? foreach ($items as $id => $item): ?>
        <option value="<?= $id ?>"><?= $item ?></option>
    <? endforeach; ?>
</div>
