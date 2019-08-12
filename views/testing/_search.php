<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TestingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'date_on') ?>

    <?= $form->field($model, 'date_of') ?>

    <?= $form->field($model, 'events_buf') ?>

    <?php // echo $form->field($model, 'updu') ?>

    <?php // echo $form->field($model, 'updt') ?>

    <?php // echo $form->field($model, 'ver') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
