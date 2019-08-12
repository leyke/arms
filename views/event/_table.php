<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 13.06.2019
 * Time: 21:52
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model \app\models\Event */

?>

<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['event/update', 'id' => $model->id],
            ['class' => 'btn btn-primary', 'target' => '_blank', 'data-pjax' => 0]) ?>
        <?= Html::a('Delete', ['event/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'target' => '_blank',
            'data-pjax' => 0,
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'type',
            'condition',
            'context',
            'complex_event',
            'source',
            'description',
            'updu',
            'updt',
            'ver',
        ],
    ]) ?>

</div>