<section>
    <div id="orderResult"></div>
    <h2>Netzdiagramm</h2>
    <?php
    echo "<pre>";
    print_r($compArray);
    echo "</pre>";
    ?>
    <?php echo form_open('', array('onsubmit' => 'return validate();')); ?>

    <div class="well carousel-search hidden-sm">

        <div id="dropdown" style="">
            <?php echo form_dropdown('type', $users, $this->input->post('type') ? $this->input->post('type') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="my_id1"'); ?> &nbsp;&nbsp;

            <div class="clr"></div>
        </div>
        <div>
            <br>
        </div>
        <div id="buttons">
            <?php
            echo form_button('button', 'Apply', 'class="btn btn-primary btn-xs" onClick="some_function()"');
            ?>

            <div class="clr"></div>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>
    <div id="competency">

    </div>

    <!--<canvas id="canvas" width="600" height="400"></canvas>-->

</script>



<canvas id="lineChart" width="600" height="400"></canvas>

</section>

<script>

    $(window).load(function () {/*code here*/


    $.ajax({
    type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/chart/getCompetency') ?>',
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {

            console.info(data.replace(/["]/g, ""));
            const CHART = document.getElementById("lineChart");
//            console.log(Chart.defaults.scale.ticks);
//            Chart.defaults.scale.ticks.beginAtZero = false;
            let barChart = new Chart(CHART, {

            type: 'bar',
                    data:{
                    labels: ["PHP", "JavaScript","HTML", "C++","Java", "Angular"],
                            datasets: [{
                            label: "Employee A",
                                    borderColor: "#00FF00",
                                    borderWidth:2,
                                    data: [40, 30,30, 50, 20,25],
                            },
                            {
                            label:"Employee B",
                                    borderColor: "rgba(200,0,0,0.6)",
                                    borderWidth:2,
                                    data: [30, 50,30, 50, 40, 10],
                            }],
                    },
            });
            },
            error: function (e) {
            console.info(e);
            },
    });
    });</script>

<script>
//    const CHART = document.getElementById("lineChart");
//    console.log(Chart.defaults.scale.ticks);
//    Chart.defaults.scale.ticks.beginAtZero = false;
//    let barChart = new Chart(CHART, {
//    type: 'bar',
//            data:{
//            labels: ["English", "Maths", "Physics", "Chemistry", "Biology", "History"],
//                    datasets: [{
//                    label: "Employee A",
////                            backgroundColor: "rgba(00,255,00,0.1)",
//                            borderColor: "#00FF00",
//                            borderWidth:2,
////                fill: false,
////                radius: 6,
////                pointRadius: 6,
////                pointBorderWidth: 3,
////                pointBackgroundColor: "orange",
////                pointBorderColor: "rgba(200,0,0,0.6)",
////                pointHoverRadius: 10,
//                            data: [30, 75, 70, 80, 60, 100],
////                            data:[Basic, Intermediate, Advance, Expert]
//                    }, {
//                    label: "Employee B",
////                            backgroundColor: "rgba(200,0,0,0.6)",
//                            borderColor: "rgba(200,0,0,0.6)",
//                            borderWidth:2,
////                fill: false,
////                radius: 6,
////                pointRadius: 6,
////                pointBorderWidth: 3,
////                pointBackgroundColor: "orange",
////                pointBorderColor: "rgba(200,0,0,0.6)",
////                pointHoverRadius: 10,
//                            data: [50, 50, 70, 80, 60, 80]
////                            data:[Basic, Intermediate, Advance, Expert]
//                    }]
//            }
//    });
</script>
<!--<script>-->
<!--    var marksCanvas = document.getElementById("marksChart");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var marksData = {
        labels: ["English", "Maths", "Physics", "Chemistry", "Biology", "History"],
        datasets: [{
                label: "Student A",
                backgroundColor: "transparent",
                borderColor: "rgba(200,0,0,0.6)",
                fill: false,
                radius: 6,
                pointRadius: 6,
                pointBorderWidth: 3,
                pointBackgroundColor: "orange",
                pointBorderColor: "rgba(200,0,0,0.6)",
                pointHoverRadius: 10,
                data: [65, 75, 70, 80, 60, 80]
            }, {
                label: "Student B",
                backgroundColor: "transparent",
                borderColor: "rgba(0,0,200,0.6)",
                fill: false,
                radius: 6,
                pointRadius: 6,
                pointBorderWidth: 3,
                pointBackgroundColor: "cornflowerblue",
                pointBorderColor: "rgba(0,0,200,0.6)",
                pointHoverRadius: 10,
                data: [54, 65, 60, 70, 70, 75]
            }]
    };

    var chartOptions = {
        scale: {
            ticks: {
                beginAtZero: true,
                min: 0,
                max: 100,
                stepSize: 20
            },
            pointLabels: {
                fontSize: 18
            }
        },
        legend: {
            position: 'left'
        }
    };

    var radarChart = new Chart(marksCanvas, {
        type: 'radar',
        data: marksData,
        options: chartOptions
    });
    function some_function()
    {

//        console.info(date_from);
        $.ajax({
            type: "POST",
            url: "reporting/displayReports/",
            data: str,
            dataType: "json",
            success: function (data) {
//                console.info(data);


            }
        });
    }

--> 
