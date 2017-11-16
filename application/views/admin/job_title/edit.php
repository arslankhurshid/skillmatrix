<h3><?php echo empty($job_title->id) ? 'Stellenbezeichnung Erstellen' : 'Bearbeiten:' . '&nbsp' . $job_title->title ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Title:</td>
        <td><?php echo form_input('title', set_value('title', $job_title->title)); ?></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
    </tr>

</table>
<div id="competency">

</div>
<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'dd.mm.yyyy'});

    });

    $(function () {

        $.post('<?php echo site_url('admin/jobtitle/order_competency/'), isset($job_title->id) ? $job_title->id : ''; ?>', {dataType: "json"}, function (data) {
//            console.info(data);
            $("#competency").html('');
            $("#competency").html(data);
//            var $el = $("#my_id2");
//            $el.empty(); // remove old options
//            $.each(JSON.parse(data), function (key, value) {
//
//                $('#my_id2').append($('<option>').text(value).attr('value', key));
//
//                console.log(key + ":" + value)
//            })
        });
    });


</script>
