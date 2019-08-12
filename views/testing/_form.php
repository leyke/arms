<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Testing */
/* @var $form yii\widgets\ActiveForm */
$events = ArrayHelper::map(\app\models\Event::find()->all(), 'id', 'name');
?>

<div class="testing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_on')->widget(\kartik\datetime\DateTimePicker::className())->label('Дата начала') ?>

    <?= $form->field($model,
        'date_of')->widget(\kartik\datetime\DateTimePicker::className())->label('Дата завершения') ?>


    <?php

    echo $form->field($model, 'rolesBuf')->widget(MultipleInput::className(), [
//        'max'               => 6,
//        'min'               => 2, // should be at least 2 rows
        'cloneButton' => true,
        'allowEmptyList' => true,
        'enableGuessTitle' => true,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'name' => 'id',
                'type' => 'hiddenInput',
                'options' => [
                    'class' => 'hidden-input-id'
                ]
            ],
            [
                'name' => 'event',
                'type' => 'dropDownList',
                'title' => 'Событие',
                'items' => $events
            ],
            [
                'name' => 'count',
                'title' => 'Количество срабатываний',
            ],
            [
                'name' => 'script',
                'title' => 'script',
            ],
        ]
    ])
        ->label(false);
    ?>

    <!--    --><? //= $form->field($model, 'events_buf')->textInput(['maxlength' => true]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'updu')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'updt')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'ver')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
