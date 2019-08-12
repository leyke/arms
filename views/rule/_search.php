<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RuleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'package') ?>

    <?= $form->field($model, 'linking_mode') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'event') ?>

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
