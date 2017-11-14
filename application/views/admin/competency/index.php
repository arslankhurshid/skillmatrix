<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Kompetenzen</h2>
    <?php echo anchor('admin/competency/edit', '<span class="glyphicon glyphicon-plus"> </span>Erstellen'); ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Name</td>
                <td >Fachbereich</td>
                <td>Bearbeiten</td>
                <td>Löschen</td>

            </tr>
        </thead>
        <tbody>
            <?php 
//            echo "<pre>";
//            print_r($competencies);
//            echo "</pre>";
            ?>
            <?php
            if (count($competencies)) :
                foreach ($competencies as $competency):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/competency/edit/' . $competency->id, $competency->name); ?> </td>
                        <td><?php echo $competency->parent_name; ?></td>
                        <td><?php echo btn_edit('admin/competency/edit/' . $competency->id) ?></td>
                        <td><?php echo btn_delete('admin/competency/delete/' . $competency->id) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any competencies.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->