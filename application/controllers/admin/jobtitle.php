<?php

class jobtitle extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('job_title_m');
        $this->load->model('competency_m');
        $this->load->model('job_title_has_comp_m');
        $this->load->model('job_title_m');
        $this->load->model('skills_m');
    }

    function index() {
        $this->data['job_title_competencies'] = $this->job_title_m->get_job_title_competencies();

        //Load view
        $this->data['subview'] = 'admin/job_title/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['job_title'] = $this->job_title_m->get($id);


            if (empty(count($this->data['job_title'])))
                $this->data['errors'][] = "Title could not be found";
        }
        else {
            $this->data['job_title'] = $this->job_title_m->get_newTitle();
        }

        $rules = $this->job_title_m->rules;

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
//            exit();
            $data = $this->job_title_m->array_from_post(array(
                'title',
            ));

            $lastInsertedID = $this->job_title_m->save($data, $id);
            if (isset($_POST) && !empty($_POST['competencies'])) {
                $competencies = $_POST['competencies'];
                if (!empty($competencies)) {
                    $this->deleteJobComp($id);
                    foreach ($_POST['competencies'] as $k => $v) {
                        // get the sub comp
                        if (isset($_POST['competency-' . $v]) && $_POST['competency-' . $v]) {
                            if (empty($lastInsertedID))
                                $lastInsertedID = $id;
                            $this->job_title_has_comp_m->save(array(
                                'job_title_id' => $lastInsertedID,
                                'competency_id' => $v,
                                'skill_value' => $_POST['competency-' . $v][0],
                            ));
//                            echo $this->db->last_query();
                        }
                    }
                }
            }
            redirect('admin/jobtitle');
        }
        $this->data['subview'] = 'admin/job_title/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function deleteJobComp($id) {
        $this->job_title_has_comp_m->deleteJobComp($id);
    }

    public function delete($id) {
        $this->job_title_m->delete($id);
        $this->deleteJobComp($id);
        redirect('admin/job_title');
    }

    public function order_competency($id = null) {

        $this->data['skills'] = $this->skills_m->skillArray();
        $this->data['selectedArray'] = $this->job_title_m->getJobTitleCompetencies($id);
        $this->data['compArray'] = $this->competency_m->getParentChild();
        $this->load->view('admin/user/order_competency', $this->data);
    }

    public function updateDropDownField($id) {

        if ($id == 0) {
            $this->data['sub_competencies'] = array();
        } else {
            $this->data['sub_competencies'] = $this->competency_m->getSubCompArray($id);
        }
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

}
