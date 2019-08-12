<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

/* @var $applications \app\models\Application[] */
/* @var $roles \app\models\Role[] */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'applications' => $applications,
        'roles' => $roles
    ]) ?>

</div>
