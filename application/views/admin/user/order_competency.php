<?php
echo "<pre>";
print_r($selectedArray);
echo "</pre>";
?>

<?php
echo '<section>';
if (count($compArray)) {
    echo '<div class="form-group">
            <label class="">Fachbereich & Kompetenzen</label>
                <ul id="tree1">';

    foreach ($compArray as $key => $value) {

        $selected = 'checked';
        ?>

        <div class="col-md-1">
            <input type="checkbox" name="parent_competencies[]" value="<?php echo $key; ?>" <?php echo $selected; ?> style="display: none">
        </div>
        <div class="col-md-7">
            <label><?php echo $value['name']; ?></label>
        </div>
        <ul id="tree1">
            <label><?php foreach ($value['child'] as $k => $val) { ?>
                    <li class="col-md-12" style="margin-top: 10px;">
                        <div class="col-md-1">
                            <input type="checkbox" name="competencies[]" value="<?php echo $k; ?>" <?php echo $selected; ?> style="display:none">
                        </div>

                        <div class="col-md-7">
                            <label><?php echo $k . $val; ?></label>
                        </div>
                        <div class="col-md-4">
                            <select name="competency-<?php echo $k ?>[]" class="form-control">

                                <?php
                                foreach ($skills as $dataKey => $dataVal) {
                                    if (isset($selectedArray) && !empty($selectedArray)) {
                                        $select = '';
                                        foreach ($selectedArray as $index => $skillID) {

                                            if ($k == $index && $dataKey == $skillID) {
                                                $select = 'selected';
                                            }
                                            echo '<option value = "' . $dataKey . '"  ' . $select . '>' . $dataVal . '</option>';
                                        }
                                    } else {
                                        $select = '';
                                        echo '<option value = "' . $dataKey . '"  ' . $select . '>' . $dataVal . '</option>';
                                    }
                                }
                                ?>

                            </select>

                        </div>

                    <?php }
                    ?></li></label>


        </ul>
        <?php
    }
    echo '</ul></div>';
}
echo '</section>';
