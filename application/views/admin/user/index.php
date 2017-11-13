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
                <td >Wohnort</td>
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
                        <td><?php echo $user->address ?></td>
                        <td><?php echo $user->ausbildung ?></td>
                        <td><?php echo anchor('admin/dashboard/edit/' . $user->id, '<span class="glyphicon glyphicon-edit"></span>') ?></td>
                        <td><?php echo anchor('admin/dashboard/delete/' . $user->id, '<span class="glyphicon glyphicon-remove"></span>', array('onclick' => "return confirm('Are you sure you want to delete. This can not be undone');")) ?></td>
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