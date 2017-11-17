<section>
    <div id="orderResult"></div>
    <h2>Netzdiagramm</h2>
    <?php echo form_open('', array('onsubmit' => 'return validate();')); ?>

    <div class="well carousel-search hidden-sm">

        <div id="dropdown" style="">
            <?php echo form_dropdown('type', $users, $this->input->post('type') ? $this->input->post('type') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="my_id1"'); ?>
            &nbsp;&nbsp;

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


    <canvas id="lineChart" width="600" height="400"></canvas>

</section>

<script>

    $(window).load(function () {/*code here*/
        var labels = <?php echo $competency_labels; ?>;

        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/chart/getCompetency') ?>',
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {
                const CHART = document.getElementById("lineChart");
                var barChart = new Chart(CHART, {
                    type: 'radar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: "Employee A",
                                borderColor: "#00FF00",
                                borderWidth: 2,
                                data: <?php echo $userCompArray; ?>,
                            },
                            {
                                label: "Employee B",
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
            },
            error: function (e) {
                console.info(e);
            },
        });
    });
</script>

