<?php 
//echo "<pre>";
//print_r($userCompArray);
//echo "</pre>";
?>
<section>
    <div id="orderResult"></div>
    <h2>Netzdiagramm</h2>
    <?php echo form_open('', array('onsubmit' => 'return validate();')); ?>

    <div class="well carousel-search hidden-sm">

        <div id="dropdown" style="">
            <?php echo form_dropdown('type', $users, $this->input->post('type') ? $this->input->post('type') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="user_id" onchange="some_function()"'); ?>
            &nbsp;&nbsp;

            <div class="clr"></div>
        </div>
        <div>
            <br>
        </div>
        <div id="buttons">
            <?php
//            echo form_button('button', 'Apply', 'class="btn btn-primary btn-xs" onClick="some_function()"');
            ?>

            <div class="clr"></div>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>
    <div id="competency">

    </div>

    <!--<canvas id="canvas" width="600" height="400"></canvas>-->


    <canvas id="lineChart" width="600" height="400"></canvas>

</section>

<script>
    function some_function() {
    var labels = <?php echo $competency_labels; ?>;
    var drop_down = document.getElementById("user_id");
    $.ajax({
    type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/chart/getCompetency/') ?>' + drop_down.value,
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {
            const CHART = document.getElementById("lineChart");
            var barChart = new Chart(CHART, {
            type: 'radar',
                    data: {
                    labels: data.competency_labels,
                            datasets: [{
                            label: "Ist",
                                    borderColor: "#00FF00",
                                    borderWidth: 2,
                                    data: data.userCompArray,
                            },
                            {
                            label: "Stellenanforderungen",
                                    borderColor: "rgba(200,0,0,0.6)",
                                    borderWidth: 2,
                                    data: data.jobsCompArray,
                            }],
                    },
                    options: {
                    scale: {
                    ticks: {
                    suggestedMin: 0,
                            suggestedMax: 4,
                            stepSize: 1,
                            callback: function (value) {
                            if (value == 1) {
                            return "Basic";
                            }
                            if (value == 2) {
                            return "Intermediate";
                            }
                            if (value == 3) {
                            return "Advance";
                            }
                            if (value == 4) {
                            return "Expert";
                            }
                            }
                    }
                    }
                    }
            });
            },
            error: function (e) {
            console.info(e);
            },
    });
    }

</script>

<script>
    var labels = <?php echo $competency_labels; ?>;
    const CHART = document.getElementById("lineChart");
    var barChart = new Chart(CHART, {
    type: 'radar',
            data: {
            labels: labels,
                    datasets: [{
                    label: "Ist",
                            borderColor: "#00FF00",
                            borderWidth: 2,
                            data: <?php echo $userCompArray; ?>,
                    },
                    {
                    label: "Stellenanforderungen",
                            borderColor: "rgba(200,0,0,0.6)",
                            borderWidth: 2,
                            data: <?php echo $jobsCompArray; ?>,
                    }],
            },
            options: {
            scale: {
            ticks: {
            suggestedMin: 0,
                    suggestedMax: 4,
                    stepSize: 1,
                    callback: function (value) {
                    if (value == 1) {
                    return "Basic";
                    }
                    if (value == 2) {
                    return "Intermediate";
                    }
                    if (value == 3) {
                    return "Advance";
                    }
                    if (value == 4) {
                    return "Expert";
                    }
                    }
            }
            }
            }
    });

</script>

