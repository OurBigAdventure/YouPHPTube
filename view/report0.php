<style>
    .card-body-icon {
        position: absolute;
        z-index: 0;
        top: -10px;
        right: 10px;
        font-size: 6rem;
        -webkit-transform: rotate(15deg);
        -ms-transform: rotate(15deg);
        transform: rotate(15deg);
    }
</style>

<div class="row dashboard">


    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-play-circle"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalVideos">0</div>
                    <div><?php echo __("Total Videos"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>mvideos">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-eye"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalVideosViews">0</div>
                    <div><?php echo __("Total Videos Views"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>mvideos">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalUsers">0</div>
                    <div><?php echo __("Total Users"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>users">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalSubscriptions">0</div>
                    <div><?php echo __("Total Subscriptions"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>subscribes">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalVideosComents">0</div>
                    <div><?php echo __("Total Video Comments"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>comments">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>    

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-thumbs-up"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalVideosLikes">0</div>
                    <div><?php echo __("Total Videos Likes"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>mvideos">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-dark o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-thumbs-down"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading" id="totalVideosDislikes">0</div>
                    <div><?php echo __("Total Videos Dislikes"); ?></div>
                </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>mvideos">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>


    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-dark bg-light o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-clock"></i>
                </div>
                <div class="mr-5">
                    <div class="huge loading text-dark" id="totalDurationVideos">0</div>
                    <div><?php echo __("Total Duration Videos (Minutes)"); ?></div>
                </div>
            </div>
            <a class="card-footer text-dark clearfix small z-1" href="<?php echo $global['webSiteRootURL']; ?>mvideos">
                <span class="float-left"><?php echo __("View Details"); ?></span>
                <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12">        
        <div class="card">
            <div class="card-body">
                <div class="btn-group">
                    <button class="btn btn-primary nav-item active" id="btnAll" ><?php echo __("Total Views"); ?></button>
                    <button class="btn btn-secondary nav-item" id="btnToday"><?php echo __("Today Views"); ?></button>
                    <button class="btn btn-outline-secondary nav-item" id="btn7"><?php echo __("Last 7 Days"); ?></button>
                    <button class="btn btn-outline-primary nav-item" id="btn30" ><?php echo __("Last 30 Days"); ?></button>
                    <!--
                    <button class="btn btn-light nav-item" id="btnUnique" ><?php echo __("Unique Users"); ?></button>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header when"><?php echo __("Color Legend"); ?></div>
            <div class="card-body" style="height: 600px; overflow-y: scroll;">
                <div class="list-group">

                    <?php
                    foreach ($labelsFull as $key => $value) {
                        ?>
                        <a class="list-group-item " style="border-color: <?= $bg[$key] ?>; border-width: 1px 20px 1px 5px; font-size: 0.9em;">
                            <?= $value ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header when"># <?php echo __("Total Views"); ?></div>
                    <div class="card-body">
                        <canvas id="myChart" height="60" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header when"># <?php echo __("Total Views"); ?></div>
                    <div class="card-body">
                        <canvas id="myChartPie" height="200"  ></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header when"># <?php echo __("Timeline"); ?></div>
                    <div class="card-body" id="timeline">
                        <canvas id="myChartLine" height="90"  ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header when"># <?php echo __("Total Views Today"), " - ", date("Y-m-d"); ?></div>
                    <div class="card-body">
                        <canvas id="myChartLineToday" height="60" ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function countTo(selector, total) {
        current = parseInt($(selector).text());
        total = parseInt(total);
        if (!total || current >= total) {
            $(selector).removeClass('loading');
            return;
        }
        var rest = (total - current);
        var step = parseInt(rest / 100);
        if (step < 1) {
            step = 1;
        }
        current += step;
        $(selector).text(current);
        var timeout = (500 / rest);
        setTimeout(function () {
            countTo(selector, total);
        }, timeout);
    }

    var ctx = document.getElementById("myChart");
    var ctxPie = document.getElementById("myChartPie");
    var ctxLine = document.getElementById("myChartLine");
    var ctxLineToday = document.getElementById("myChartLineToday");
    var chartData = {
        labels: <?php echo json_encode($labelsFull); ?>,
        datasets: [{
                label: '# <?php echo __("Total Views"); ?>',
                data: <?php echo json_encode($datas); ?>,
                backgroundColor: <?php echo json_encode($bg); ?>,
                borderColor: <?php echo json_encode($bc); ?>,
                borderWidth: 1
            }]
    };

    var lineChartData = {
        labels: <?php echo json_encode($label90Days); ?>,
        datasets: [{
                backgroundColor: 'rgba(255, 0, 0, 0.3)',
                borderColor: 'rgba(255, 0, 0, 0.5)',
                label: '# <?php echo __("Total Views (90 Days)"); ?>',
                data: <?php echo json_encode($statistc_last90Days); ?>
            }]
    };

    var lineChartDataToday = {
        labels: <?php echo json_encode($labelToday); ?>,
        datasets: [{
                backgroundColor: 'rgba(0, 0, 255, 0.3)',
                borderColor: 'rgba(0, 0, 255, 0.5)',
                label: '# <?php echo __("Total Views (Today)"); ?>',
                data: <?php echo json_encode($statistc_lastToday); ?>
            }]
    };

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        display: false
                    }]
            },
            legend: {
                display: false
            },
            responsive: true
        }
    });
    var myChartPie = new Chart(ctxPie, {
        type: 'pie',
        data: chartData,
        options: {
            legend: {
                display: false
            },
            responsive: true
        }
    });

    var myChartLine = new Chart(ctxLine, {
        type: 'line',
        data: lineChartData,
        fill: false,
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }]
            },
            legend: {
                display: false
            },
            responsive: true,
            title: {
                display: true
            }
        }
    });

    var myChartLineToday = new Chart(ctxLineToday, {
        type: 'line',
        data: lineChartDataToday,
        fill: false,
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }]
            },
            legend: {
                display: false
            },
            responsive: true,
            title: {
                display: true
            }
        }
    });

    $(document).ready(function () {
        countTo('#totalVideos', <?php echo $totalVideos; ?>);
        countTo('#totalUsers', <?php echo $totalUsers; ?>);
        countTo('#totalSubscriptions', <?php echo $totalSubscriptions; ?>);
        countTo('#totalVideosComents', <?php echo $totalComents; ?>);
        countTo('#totalVideosLikes', <?php echo $totalInfos->likes; ?>);
        countTo('#totalVideosDislikes', <?php echo $totalInfos->disLikes; ?>);
        countTo('#totalVideosViews', <?php echo $totalInfos->views_count; ?>);
        countTo('#totalDurationVideos', <?php echo $totalInfos->total_minutes; ?>);

        $('#btnAll').click(function () {
            $('.nav-chart .btn').removeClass('active');
            $(this).addClass('active');
            chartData.datasets[0].data = <?php echo json_encode($datas); ?>;
            chartData.datasets[0].label = '# <?php echo __("Total Views"); ?>';
            lineChartData.labels = <?php echo json_encode($label90Days); ?>;
            lineChartData.datasets[0].data = <?php echo json_encode($statistc_last90Days); ?>;
            lineChartData.datasets[0].label = '# <?php echo __("Total Views (90 Days)"); ?>';
            myChart.update();
            myChartPie.update();
            myChartLine.update();
        });
        $('#btnToday').click(function () {
            $('.nav-chart .btn').removeClass('active');
            $(this).addClass('active');
            chartData.datasets[0].data = <?php echo json_encode($datasToday); ?>;
            chartData.datasets[0].label = '# <?php echo __("Today"); ?>';
            lineChartData.labels = <?php echo json_encode($labelToday); ?>;
            lineChartData.datasets[0].data = <?php echo json_encode($statistc_lastToday); ?>;
            lineChartData.datasets[0].label = '# <?php echo __("Today"); ?>';
            myChart.update();
            myChartPie.update();
            myChartLine.update();
        });
        $('#btn7').click(function () {
            $('.nav-chart .btn').removeClass('active');
            $(this).addClass('active');
            chartData.datasets[0].data = <?php echo json_encode($datas7); ?>;
            chartData.datasets[0].label = '# <?php echo __("Last 7 Days"); ?>';
            lineChartData.labels = <?php echo json_encode($label7Days); ?>;
            lineChartData.datasets[0].data = <?php echo json_encode($statistc_last7Days); ?>;
            lineChartData.datasets[0].label = '# <?php echo __("Last 7 Days"); ?>';
            myChart.update();
            myChartPie.update();
            myChartLine.update();
        });
        $('#btn30').click(function () {
            $('.nav-chart .btn').removeClass('active');
            $(this).addClass('active');
            chartData.datasets[0].data = <?php echo json_encode($datas30); ?>;
            chartData.datasets[0].label = '# <?php echo __("Last 30 Days"); ?>';
            lineChartData.labels = <?php echo json_encode($label30Days); ?>;
            lineChartData.datasets[0].data = <?php echo json_encode($statistc_last30Days); ?>;
            lineChartData.datasets[0].label = '# <?php echo __("Last 30 Days"); ?>';
            myChart.update();
            myChartPie.update();
            myChartLine.update();
        });
        $('#btnUnique').click(function () {
            $('.nav-chart .btn').removeClass('active');
            $(this).addClass('active');
            chartData.datasets[0].data = <?php echo json_encode($datasUnique); ?>;
            chartData.datasets[0].label = '# <?php echo __("Unique Users"); ?>';
            myChart.update();
            myChartPie.update();
        });
    });
</script>
