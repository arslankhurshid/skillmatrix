<h3><?php echo empty($user->id) ? 'Mitarbeiter Stammdaten' : 'Bearbeiten:' . '&nbsp' . $user->fname ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Vorname:</td>
        <td><?php echo form_input('fname', set_value('fname', $user->fname)); ?></td>
    </tr>
    <tr>
        <td>Nachname:</td>
        <td><?php echo form_input('lname', set_value('lname', $user->fname)); ?></td>
    </tr>
    <tr>
        <td>Stellenbezeichnung:</td>
        <td><?php echo form_input('job_title', set_value('job_title', $user->job_title)); ?></td>
    </tr>
    <tr>
        <td>Geburtsdatum:</td>
        <td><?php echo form_input('dob', set_value('dob', $user->dob), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Wohnort:</td>
        <td><?php echo form_input('address', set_value('address', $user->address)); ?></td>
    </tr>
    <tr>
        <td>Ausbildung:</td>
        <td><?php echo form_input('ausbildung', set_value('ausbildung', $user->ausbildung)); ?></td>
    </tr>
    <tr>
        <td>Fachbereich:</td>
        <td><?php echo form_dropdown('parent_id', $competency_without_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $user->parent_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
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

    var drop_down = document.getElementById("my_id");
    $(function () {

        $.post('<?php echo site_url('admin/dashboard/updateDropDownField/'); ?>', {dataType: "json"}, function (data) {
            console.info(data);
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
    })
    ;


</script>
