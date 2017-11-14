<h3><?php echo empty($job_title->id) ? 'Stellenbezeichnung Erstellen' : 'Bearbeiten:' . '&nbsp' . $job_title->fname ?></h3>
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
        <td>Fachbereich:</td>
        <td><?php echo form_dropdown('parent_id', '', $this->input->post('parent_id') ? $this->input->post('parent_id') : $job_title->parent_id, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
    </tr>

</table>
<?php
echo get_ol($competencies);

function get_ol($array, $child = false) {
    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '<ol>' : '<ol>';

        foreach ($array as $item) {
            echo "<pre>";
            print_r($item);
            echo "</pre>";
            $str .= '<li id="list_' . $item['id'] . '">';
            $str .= '<div>' . $item['name'] . '</div>';
            // if have children
            if (isset($item['children']) && count($item['children'])) {

                $str .= get_ol($item['children'], FALSE);
            }

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }
    return $str;
}
?>
<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'dd.mm.yyyy'});

    });

    var drop_down = document.getElementById("my_id");
    drop_down.onchange = function () {

        $.post('<?php echo site_url('admin/dashboard/updateDropDownField/'); ?>' + drop_down.value, {dataType: "json"}, function (data) {
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
    };


</script>
