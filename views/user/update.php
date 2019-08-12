<?php

use app\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */


/* @var $applications \app\models\Application[] */
/* @var $roles \app\models\Role[] */

$this->title = 'Редактировать ' . User::ONE_NAME .' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'applications' => $applications,
        'roles' => $roles
    ]) ?>

</div>
