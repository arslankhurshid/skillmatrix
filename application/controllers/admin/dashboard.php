<?php

class dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
        $this->load->model('competency_m');
    }

    function index() {
        $this->data['users'] = $this->user_m->get();
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
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            exit();
            $data = $this->user_m->array_from_post(array(
                'fname',
                'lname',
                'job_title',
                'dob',
                'address',
                'ausbildung',
            ));

            $this->user_m->save($data, $id);
//            redirect('admin/user');
        }
        $this->data['subview'] = 'admin/user/edit';
        $this->data['competency_without_parents'] = $this->competency_m->get_no_parents($id);
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->user_m->delete($id);
        redirect('admin/user');
    }

    public function updateDropDownField($id) {
        if ($id == 0) {
            $this->data['sub_competencies'] = array(0 => 'Keine');
        } else {
            $this->data['sub_competencies'] = $this->competency_m->getSubCompArray($id);
        }
        if (count($this->data['sub_competencies'])) {
            echo '<div class="form-group">
            <label class="">Kompetenzen</label>
                <ul id="tree1">
                ';

            foreach ($this->data['sub_competencies'] as $key => $value) {
//                echo "<pre>";
//                print_r($value);
//                echo "</pre>";
//        $weight = '';
                $selected = '';
                if ($value == $key) {
                    $selected = 'checked';
                }
//                if (isset($_POST['competency']) && !empty($_POST['competency'])) {
//                }
//        if (isset($_POST['competencyWeight' . $row['id']]) && $_POST['competencyWeight' . $row['id']] != '') {
//            $weight = $_POST['competencyWeight' . $row['id']];
//        }
                ?>
                <li class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-1">
                        <input type="checkbox" name="competency[]" id="<?php echo $key; ?>" class="cbgroup1" value="<?php echo $key; ?>" <?php echo $selected; ?>>
                    </div>
                    <div class="col-md-9">
                        <label><?php echo $value; ?></label>
                    </div>
                    <div class="col-md-1">
                        <!--<input type="text" class="form-control" name="skillvalue<?php // echo $key;  ?>" value="<?php // echo $weight;  ?>" placeholder="Enter Weight">-->
                        <?php echo form_dropdown('skill_id', array('Good', 'Expert', 'Intermediate'), $this->input->post('skill_id') ? $this->input->post('skill_id') : $key, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?>
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

}
