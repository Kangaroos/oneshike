@extends('admin.layouts.admin')

@section('container')
<div class="row">
    <div class="col-xs-12">
        <h1 style="margin-top:2em; text-align:center;">后台首页</h1>
        <p style="text-align:center;">功能开发中。</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <!-- interactive chart -->
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">在线统计（演示）</h3>
                <div class="box-tools pull-right">
                    实时数据监控
                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                        <button type="button" class="btn btn-default btn-xs active" data-toggle="on">开</button>
                        <button type="button" class="btn btn-default btn-xs" data-toggle="off">关</button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="interactive" style="height: 300px;"></div>
            </div><!-- /.box-body-->
        </div><!-- /.box -->

    </div><!-- /.col -->
</div><!-- /.row -->
@stop


@section('end')
@parent
<!-- FLOT CHARTS -->
<script src="{{ asset('/static/admin/js/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('/static/admin/js/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('/static/admin/js/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{ asset('/static/admin/js/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<!-- Page script -->
<script type="text/javascript">

$(function() {

    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [], totalPoints = 100;
    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk
        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }

        return res;
    }

    var interactive_plot = $.plot("#interactive", [getRandomData()], {
        grid: {
            borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3"
        },
        series: {
            shadowSize: 0, // Drawing is faster without shadows
            color: "#3c8dbc"
        },
        lines: {
            fill: true, //Converts the line chart to area chart
            color: "#3c8dbc"
        },
        yaxis: {
            min: 0,
            max: 100,
            show: true
        },
        xaxis: {
            show: true
        }
    });

    var updateInterval = 500; //Fetch data ever x milliseconds
    var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
    function update() {

        interactive_plot.setData([getRandomData()]);

        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw();
        if (realtime === "on")
            setTimeout(update, updateInterval);
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === "on") {
        update();
    }
    //REALTIME TOGGLE
    $("#realtime .btn").click(function() {
        if ($(this).data("toggle") === "on") {
            realtime = "on";
        }
        else {
            realtime = "off";
        }
        update();
    });
    /*
     * END INTERACTIVE CHART
     */

});
</script>
@stop