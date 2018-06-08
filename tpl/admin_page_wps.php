<div class="wrap">
    <h1>آمار بازدید کنندگان</h1>
    <div id="dashboard-widgets" class="metabox-holder">
        <div id="postbox-container-1" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <div id="dashboard_right_now" class="postbox">
                    <h2 class="hndle ui-sortable-handle"><span>خلاصه آمار بازدید</span></h2>
                    <div class="inside">
                        <div class="main">
                            <p>
                                <span>بازدید کل: </span>
                                <span><?php echo $totalStatistics->total_visits ?></span>
                            </p>
                            <p>
                                <span>بازدید یکتای کل: </span>
                                <span><?php echo $totalStatistics->total_unique_visits ?></span>
                            </p>
                            <hr>

                            <p>
                                <span>بازدید کل امروز: </span>
                                <span><?php echo intval($todayStatistics->total_visits) ?></span>
                            </p>
                            <p>
                                <span>بازدید یکتای امروز: </span>
                                <span><?php echo intval($todayStatistics->unique_visits) ?></span>
                            </p>
                            <hr>

                            <p>
                                <span>بازدید کل دیروز: </span>
                                <span><?php echo intval($yesterdayStatistics->total_visits) ?></span>
                            </p>
                            <p>
                                <span>بازدید یکتای دیروز: </span>
                                <span><?php echo intval($yesterdayStatistics->unique_visits) ?></span>
                            </p>
                            <hr>

                            <p>
                                <span>بازدید کل ماهانه: </span>
                                <span><?php echo intval($monthStatistics->total_visits) ?></span>
                            </p>
                            <p>
                                <span>بازدید یکتای ماهانه: </span>
                                <span><?php echo intval($monthStatistics->unique_visits) ?></span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="postbox-container-2" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <div id="dashboard_right_now" class="postbox">
                    <h2 class="hndle ui-sortable-handle"><span>نمودار</span></h2>
                    <div class="inside">
                        <div class="main">

                            <div class="form-action">
                                <form action="#" method="get">
                                    <input type="hidden" name="page" value="wps-stat.php">

                                    <label for="start">شروع تاریخ</label>
                                    <input type="text" name="startDate" class="selectDate" id="start" autocomplete="off">

                                    <label for="end">پایان تاریخ</label>
                                    <input type="text" name="endDate" class="selectDate" id="end" autocomplete="off">

                                    <input type="submit" value="فیلتر کردن">
                                </form>
                            </div>
                            <canvas id="myChart" width="400" height="400"></canvas>

                            <script>
                                var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: <?php echo json_encode($visitDate); ?>,
                                        datasets: [{
                                            label: 'تعداد بازدید',
                                            data: <?php echo json_encode($visittotal) ?>,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 2
                                        }, {
                                            label: 'تعداد بازدید های یکتا',
                                            data: <?php echo json_encode($uniqvisit) ?>,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
