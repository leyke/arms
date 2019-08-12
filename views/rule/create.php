<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */
/* @var $blockRuleModel \app\models\BlockRule */

$this->title = 'Create Rule';
$this->params['breadcrumbs'][] = ['label' => \app\models\Rule::LABEL, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',
        ['model' => $model, 'blockRuleModel' => $blockRuleModel]);
    ?>
</div>