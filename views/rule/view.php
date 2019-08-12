<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height:550px;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/plugins/forceDirected.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

        chart.data = [
            {
                name: "Правило 1",
                children: [
                    {
                        name: "Событие 3",
                        children: [
                            { name: "Событие 1", value: 100 },
                            { name: "Событие 2", value: 60 }
                        ]
                    },
                    {
                        name: "Действие 1",
                        children: [
                            { name: "Событие 4", value: 135 },
                        ]
                    },

                ]
            }
        ];

        networkSeries.dataFields.value = "value";
        networkSeries.dataFields.name = "name";
        networkSeries.dataFields.children = "children";
        networkSeries.nodes.template.tooltipText = "{name}:{value}";
        networkSeries.nodes.template.fillOpacity = 1;
        networkSeries.manyBodyStrength = -20;
        networkSeries.links.template.strength = 0.8;
        networkSeries.minRadius = am4core.percent(2);

        networkSeries.nodes.template.label.text = "{name}"
        networkSeries.fontSize = 10;

    }); // end am4core.ready()
</script>

<div class="rule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
            'package',
            'linking_mode',
            'type',
            'state',
            'event',
            'description',
            'updu',
            'updt',
            'ver',
        ],
    ]) ?>

    <div id="chartdiv"></div>

</div>
