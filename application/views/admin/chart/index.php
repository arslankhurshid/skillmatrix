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



</section>

<script>
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
