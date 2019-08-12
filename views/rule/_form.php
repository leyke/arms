<?php

use app\models\Event;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */
/* @var $form yii\widgets\ActiveForm */
/* @var $blockRuleModel \app\models\BlockRule */

$this->registerJsFile('/js/dropdown.js',
    ['pos' => \yii\web\View::POS_END, 'depends' => \app\assets\AppAsset::className()]);

$events = \yii\helpers\ArrayHelper::map(Event::find()->all(),
    'id', 'name');
$conditions = \yii\helpers\ArrayHelper::map(\app\models\Condition::find()->all(),
    'id', 'script');
$actions = \yii\helpers\ArrayHelper::map(\app\models\Action::find()->all(),
    'id', 'script');
?>

<div class="rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php Pjax::begin(['id' => 'events', 'options' => ['class' => 'dropdown-wrap']]) ?>
    <?= $form->field($model, 'event')->dropDownList($events,
        ['data-type' => Event::DATA_TYPE, 'class' => 'form-control js-dropdown']) ?>
    <? if ($events): ?>
        <?= Html::button('<i class="fas fa-eye"></i>', ['class' => 'btn btn-info js-view-btn']) ?>
        <?= Html::button('<i class="fas fa-pen"></i>', ['class' => 'btn btn-primary js-update-btn']) ?>
    <? endif; ?>
    <?= Html::button('<i class="fas fa-plus"></i>', ['class' => 'btn btn-success js-create-btn']) ?>
    <?php Pjax::end() ?>

    <?php Pjax::begin(['id' => 'conditions', 'options' => ['class' => 'dropdown-wrap']]) ?>
    <?= $form->field($blockRuleModel,
        'condition')->dropDownList($conditions,
        ['data-type' => \app\models\Condition::DATA_TYPE, 'class' => 'form-control js-dropdown']) ?>
    <? if ($conditions): ?>
        <?= Html::button('<i class="fas fa-pen"></i>', ['class' => 'btn btn-primary js-update-btn']) ?>
    <? endif; ?>
    <?= Html::button('<i class="fas fa-plus"></i>', ['class' => 'btn btn-success js-create-btn']) ?>
    <?php Pjax::end() ?>

    <?php Pjax::begin(['id' => 'actions', 'options' => ['class' => 'dropdown-wrap']]) ?>
    <?= $form->field($blockRuleModel,
        'action')->dropDownList($actions,
        ['data-type' => \app\models\Action::DATA_TYPE, 'class' => 'form-control js-dropdown']) ?>
    <? if ($actions): ?>
        <?= Html::button('<i class="fas fa-pen"></i>', ['class' => 'btn btn-primary js-update-btn']) ?>
    <? endif; ?>
    <?= Html::button('<i class="fas fa-plus"></i>', ['class' => 'btn btn-success js-create-btn']) ?>
    <?php Pjax::end() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'package')->textInput() ?>

    <?= $form->field($model, 'linking_mode')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

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


<?php
Modal::begin([
    'id' => 'modal'
]);
?>
<?php Pjax::begin(['id' => 'pjax-wrap', 'class' => 'content']) ?>

<?php Pjax::end(); ?>
<?php Modal::end(); ?>

