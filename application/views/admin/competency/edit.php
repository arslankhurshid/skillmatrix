<h3><?php echo empty($competency->id) ? 'Neue Kompetenz' : 'Bearbeiten:' . '&nbsp' . $competency->name ?></h3>
<?php if (!empty(validation_errors())): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Fachbereich:</td>
        <td><?php echo form_dropdown('parent_id', $competency_without_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $competency->parent_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
    </tr>
    <tr>
        <td>Kompetenz Name:</td>
        <td><?php echo form_input('name', set_value('name', $competency->name)); ?></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>
