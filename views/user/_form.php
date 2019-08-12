<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

/* @var $applications \app\models\Application[] */
/* @var $roles \app\models\Role[] */

if (!$model->isNewRecord) {
    $js = <<<JS
    $(document).find('.js-input-remove').on('click', function() {
        var inputField = $(this).parent().parent().find('.hidden-input-id');
        var userRoleId = inputField.val();
        
        $.ajax({
            method: "POST",
            url: "/user/delete-param/",
            data: {param_id:userRoleId}
        }).done(function( msg ) {
            console.log('success');
        });
    })
JS;

    $this->registerJs($js);
}
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php

    if (!empty($applications) && !empty($roles)) {
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
                    'name' => 'application',
                    'type' => 'dropDownList',
                    'title' => \app\models\Application::NAME,
                    'items' => $applications
                ],
                [
                    'name' => 'role',
                    'title' => \app\models\Role::NAME,
                    'type' => 'dropDownList',
                    'items' => $roles
                ],
                [
                    'name' => 'description',
                    'title' => 'Описание',
                ],
            ]
        ])
            ->label(false);
    }
    ?>

    <!--    --><? //= $form->field($model, 'updu')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'updt')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'ver')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
