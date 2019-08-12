<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
/* @var $eventModel \app\models\Event */

?>
<div class="event-form">
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['data-pjax' => true],
        'action' => ['event/save-ajax']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'condition')->textInput() ?>

    <?= $form->field($model, 'context')->textInput() ?>

    <?= $form->field($model, 'complex_event')->textInput() ?>

    <?= $form->field($model, 'source')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'updu')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'updt')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'ver')->textInput() ?>

    <? if (!$model->isNewRecord) : ?>
        <?= Html::hiddenInput('model_id', $model->id); ?>
    <? endif; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
