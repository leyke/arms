$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var rule_id = $(".rule-view").attr('data-rule-id');

    var data = [];

    am4core.ready(function () {

        am4core.useTheme(am4themes_animated);

        chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);

        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());

        $.ajax({
            method: "POST",
            url: "/rule/chart/",
            data: {rule_id: rule_id, csrfToken: csrfToken}
        }).done(function (answer) {
            data = JSON.parse(answer);
            console.log(data.res);
            chart.data = data.res;
        });


        networkSeries.dataFields.value = "value";
        networkSeries.dataFields.name = "name";
        networkSeries.dataFields.children = "children";
        networkSeries.dataFields.color = "color";
        networkSeries.dataFields.id = "id";


        networkSeries.nodes.template.tooltipText = "{name}:{id}";
        networkSeries.nodes.template.fillOpacity = 1;
        networkSeries.manyBodyStrength = -70;
        networkSeries.links.template.strength = 0.8;
        networkSeries.centerStrength = 1;
        networkSeries.minRadius = am4core.percent(5);

        networkSeries.nodes.template.label.text = "{name}";
        networkSeries.fontSize = 10;


    });

    $('.js-legend-btn').click(function () {
        $(this).toggleClass('disabled');
        var $filtersBtns = $('.js-legend-btn');
        var filter = [];
        $filtersBtns.each(function () {
            if (!$(this).hasClass('disabled')) {
                filter.push($(this).attr('data-filter'));
            }
        });
        chart.series.removeIndex(0);

        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());
        networkSeries.dataFields.value = "value";
        networkSeries.dataFields.name = "name";
        networkSeries.dataFields.children = "children";
        networkSeries.dataFields.color = "color";
        networkSeries.dataFields.id = "id";


        networkSeries.nodes.template.tooltipText = "{name}:{id}";
        networkSeries.nodes.template.fillOpacity = 1;
        networkSeries.manyBodyStrength = -50;
        networkSeries.links.template.strength = 0.8;
        networkSeries.centerStrength = 1;
        networkSeries.minRadius = am4core.percent(5);

        networkSeries.nodes.template.label.text = "{name}";
        networkSeries.fontSize = 10;
        $.ajax({
            method: "POST",
            url: "/rule/chart/",
            data: {rule_id: rule_id, filter: JSON.stringify(filter), csrfToken: csrfToken}
        }).done(function (answer) {
            data = JSON.parse(answer);
            console.log(data.res);
            chart.data = data.res;
        });
    });
});