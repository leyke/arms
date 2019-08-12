<?php

/* @var $this yii\web\View */
/* @var $model app\models\Condition */

/* @var $items array */
/* @var $newModelID integer */

?>

<p>Список Условий</p>
<div class="result" data-model-type="<?= \app\models\Condition::DATA_TYPE ?>"
     <? if ($newModelID): ?>data-newModelID="<?= $newModelID ?>"<? endif; ?>>
    <? foreach ($items as $id => $item): ?>
        <option value="<?= $id ?>"><?= $item ?></option>
    <? endforeach; ?>
</div>
