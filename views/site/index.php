<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Active Rule Management System';

?>

<div class="site-index">

    <div class="jumbotron">
        <h1><?= $this->title ?></h1>

    </div>

<!--    <div class="body-content">-->
<!--        <p>-->
<!--            --><?//= Html::a('Create Rule', ['rule/create'], ['class' => 'btn btn-success']) ?>
<!--        </p>-->
<!---->
<!--        --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--        --><?//= GridView::widget([
//            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
//            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//                'name',
////            'event_id',
////            'condition_id',
////            'action_id',
//
//                ['class' => 'yii\grid\ActionColumn'],
//            ],
//        ]); ?>
<!--    </div>-->
</div>
