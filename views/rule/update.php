<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */
/* @var $blockRuleModel \app\models\BlockRule */

$this->title = 'Update Rule: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'blockRuleModel' => $blockRuleModel
    ]) ?>

</div>
