<!--<div class="container">-->
<!--<div class="row col-md-8">-->
<section>
    <h2>Mit Arbeiter</h2>
    <?php echo anchor('admin/dashboard/edit', '<span class="glyphicon glyphicon-plus"> </span>Erstellen'); ?>


    <table class="table table-striped" width="100%">
        <thead>
            <tr>
                <td >Name</td>
                <td >Stellenbezeichnung</td>
                <td >Geburtsdatum</td>
                <td >Ausbildung</td>
                <td>Edit</td>
                <td>Delete</td>

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($users)) :
                foreach ($users as $user):
                    ?>


                    <tr>
                        <td><?php echo anchor('admin/dashboard/edit/' . $user->id, $user->fname . " " . $user->lname); ?> </td>
                        <td><?php echo $user->job_title; ?></td>
                        <td><?php echo $user->dob ?></td>
                        <td><?php echo $user->ausbildung ?></td>
                        <td><?php echo btn_edit('admin/dashboard/edit/' . $user->id) ?></td>
                        <td><?php echo btn_delete('admin/dashboard/delete/' . $user->id) ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"> We could not find any users.</td>
                </tr>

            <?php endif; ?>

    </table>
</section>

<!--</div></div>-->