<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ConditionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="condition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'script') ?>

    <?= $form->field($model, 'context') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'updu') ?>

    <?php // echo $form->field($model, 'updt') ?>

    <?php // echo $form->field($model, 'ver') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
