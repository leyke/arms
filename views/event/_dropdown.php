<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

/* @var $items array */
/* @var $newModelID integer */

?>

<p>Список Событий</p>
<div class="result" data-model-type="<?= \app\models\Event::DATA_TYPE ?>"
     <? if ($newModelID): ?>data-newModelID="<?= $newModelID ?>" <? endif; ?>>
    <? foreach ($items as $id => $item): ?>
        <option value="<?= $id ?>"><?= $item ?></option>
    <? endforeach; ?>
</div>
