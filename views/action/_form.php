<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Action */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'script')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'context')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'updu')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updt')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'ver')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
