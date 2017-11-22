<div class="modal-header">
    <h3>Log in</h3>
    <p>Please log in using your credentials</p>
    <div class="modal-body">
        <?php
//        echo "<pre>";
//        echo print_r($this->session->userdata, TRUE);
//        print_r($this->session);
//        echo "</pre>";
//        echo "</pre>";
//        echo "Session ID:" . session_id() . "<br>";
//        echo "Remote Address: " . $_SERVER['REMOTE_ADDR'] . "<br>";
//        echo "User Agent: " . $this->input->user_agent() . "<br>";
        ?>
        <?php if (!empty(validation_errors())): ?>
            <div class="alert alert-danger" id="errordiv">
                <?php echo validation_errors() ?>
            </div>
        <?php endif; ?>
        <?php
        echo $this->session->flashdata('success');
        if ($this->session->flashdata('errors')) {
            echo $this->session->flashdata('errors');
        }
        ?>
        <?php echo form_open(); ?>
        <table class="table">
            <tr>
                <td>User Name:</td>
                <td><?php echo form_input('user_name'); ?></td>
            </tr>
            <tr>
                <td>Password:</td> 
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="login" class="btn btn-primary" onclick="show()">
                </td>
            <!--<input type = "button" value = "Show image for 5 seconds" onclick = "show()"><br><br>-->


            </tr>

        </table>

        <?php echo form_close(); ?>
        <?php
        if ($this->session->flashdata('success')) {
            echo $this->session->flashdata('success');
        }
        ?>
    </div>
    <div id="myDiv">
        <img id="myImage" src="<?php echo site_url(); ?>/public_html/images/2.gif">
    </div>
</div>


<script type = "text/javascript">
    function hide() {
        document.getElementById("myDiv").style.display = "none";
    }
    hide();
//    setTimeout(show, 3000);
    function show() {
        $("#myDiv").show().delay(3000).fadeOut();
//        setTimeout(function () {
//            document.getElementById("myDiv").style.display = "none";
//        }, 50000);
    }

</script>