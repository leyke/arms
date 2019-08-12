<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Testing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_on',
            'date_of',
            'events_buf',
            //'updu',
            //'updt',
            //'ver',
            //'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
