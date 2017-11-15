<?php

class dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
        $this->load->model('competency_m');
        $this->load->model('user_has_comp_m');
    }

    function index() {
        $this->data['users'] = $this->user_m->get();
        $this->data['user_competencies'] = $this->user_m->get_user_competencies();
        //Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function modal() {
        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['user'] = $this->user_m->get($id);
            if (empty(count($this->data['user'])))
                $this->data['errors'][] = "User could not be found";
        }
        else {
            $this->data['user'] = $this->user_m->get_newUser();
        }

        $rules = $this->user_m->rules_admin;

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {

//            echo "<pre>";
//            print_r($_POST);
//            echo "</pre>";
//            exit();
//            exit();

            $data = $this->user_m->array_from_post(array(
                'fname',
                'lname',
                'job_title',
                'dob',
                'address',
                'ausbildung',
            ));

            $lastInsertedID = $this->user_m->save($data, $id);
            if (isset($_POST) && !empty($_POST['competencies'])) {
                $competencies = $_POST['competencies'];
                if (!empty($competencies)) {
                    foreach ($_POST['competencies'] as $k => $v) {
                        // get the sub comp
                        if (isset($_POST['competency-' . $v]) && $_POST['competency-' . $v] != '') {

                            $this->user_has_comp_m->save(array(
                                'user_id' => $lastInsertedID,
                                'competency_id' => $v,
                                'skill_value' => $_POST['competency-' . $v][0],
                                    ), $id);
                        }
                    }
                }
            }
            redirect('admin/dashboard');
        }
        $this->data['subview'] = 'admin/user/edit';
        $this->data['competency_without_parents'] = $this->competency_m->get_no_parents($id);
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->user_m->delete($id);
        redirect('admin/user');
    }

    public function updateDropDownField($id=null) {

        if ($id == 0) {
            $this->data['sub_competencies'] = array();
        }
        $this->data['sub_competencies'] = $this->competency_m->getSubCompArray($id);
        
        if (count($this->data['sub_competencies'])) {
            echo '<div class="form-group">
            <label class="">Kompetenz</label>
                <ul id="tree1">';

            foreach ($this->data['sub_competencies'] as $key => $value) {

                $selected = '';
                ?>
                <li class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-1">
                        <input type="checkbox" name="competencies[]" value="<?php echo $key; ?>" <?php echo $selected; ?>>
                    </div>
                    <div class="col-md-7">
                        <label><?php echo $value; ?></label>
                    </div>
                    <div class="col-md-4">
                        <select name="competency-<?php echo $key ?>[]" class="form-control">

                            <?php
                            $data = array('' => 'Keine', 'basic' => 'Basic', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced', 'expert' => 'Expert');
                            foreach ($data as $key => $val) {
                                echo '<option value = "' . $key . '">' . $val . '</option>';
                            }
                            ?>

                        </select>



                    </div>
                </li>
                <?php
            }
            echo '</ul></div>';
        }
//        echo json_encode($this->data['sub_competencies']);
//        $competencies = $this->competency_m->get_with_parent($id);
//        echo json_encode($competencies);
    }

    function IsChecked($chkname, $value) {
        if (!empty($_POST[$chkname])) {
            foreach ($_POST[$chkname] as $chkval) {
                if ($chkval == $value) {
                    return true;
                }
            }
        }
        return false;
    }

}
