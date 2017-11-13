<h3><?php echo empty($user->id) ? 'Erstell eine neue Mitarbeiter' : 'Bearbeiten:' . '&nbsp' . $user->fname ?></h3>
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
        <td><?php echo form_input('ausbildung', set_value('ausbildung', $user->address)); ?></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'dd.mm.yyyy'});

    });


</script>