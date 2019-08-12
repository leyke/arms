<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'package',
            'linking_mode',
            'type',
            [
                'label' => 'Обработка',
                'format'    => 'raw',
                'value'     =>  function($m){
                    $activate_url = Url::to(['activate' , 'id' => $m->id]);
                    return Html::checkbox(null,$m->state,[
                        'onchange'   => "$.get('$activate_url')"
                    ]);
                }
            ],
            //'state',
            //'event',
            //'description',
            //'updu',
            //'updt',
            //'ver',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
