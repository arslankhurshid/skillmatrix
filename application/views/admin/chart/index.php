<section>
    <div id="orderResult"></div>
    <h2>Netzdiagramm</h2>
    <?php
//    echo "<pre>";
//    print_r($users);
//    echo "</pre>";
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
    
    <canvas id="marksChart" width="600" height="400"></canvas>



</section>

<script>
    var marksCanvas = document.getElementById("marksChart");

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

    $(window).load(function () {/*code here*/

        var drop_down_type = $('#my_id1').find('option:selected').val();
        var drop_down_account = $('#my_id2').find('option:selected').val();
        var drop_down_date = $('#my_id3').find('option:selected').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: '',
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {


            },
            error: function (e) {
//                console.info(e));
            },
        });

    });

</script>
