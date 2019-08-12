<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'condition') ?>

    <?= $form->field($model, 'context') ?>

    <?php // echo $form->field($model, 'complex_event') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'updu') ?>

    <?php // echo $form->field($model, 'updt') ?>

    <?php // echo $form->field($model, 'ver') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
