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



<!--                            <form action="#" method="get">-->
<!--                                تاریخ دلخواه وارد کنید:-->
<!--                                <input type="date" name="bday">-->
<!--                                <input type="submit" name="ali">-->
<!--                            </form>-->
<!--                            --><?php //var_dump($_GET['name']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
