<?php

class dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
        $this->load->model('competency_m');
        $this->load->model('user_has_comp_m');
        $this->load->model('job_title_m');
        $this->load->model('skills_m');
    }

    function index() {
//        $this->data['users'] = $this->user_m->get();
        $this->data['users'] = $this->user_m->get_user_view_details();
        //Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function modal() {
        $this->load->view('admin/_layout_modal.php', $this->data['subview']);
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
//            exit();
            $data = $this->user_m->array_from_post(array(
                'fname',
                'lname',
                'job_title_id',
                'dob',
                'address',
                'ausbildung',
            ));

            $lastInsertedID = $this->user_m->save($data, $id);
            if (isset($_POST) && !empty($_POST['competencies'])) {
                $competencies = $_POST['competencies'];
                if (!empty($competencies)) {
                    $this->deleteUserComp($id);
                    foreach ($_POST['competencies'] as $k => $v) {
                        // get the sub comp
                        if (isset($_POST['competency-' . $v]) && $_POST['competency-' . $v]) {
                            if (empty($lastInsertedID))
                                $lastInsertedID = $id;
                            $this->user_has_comp_m->save(array(
                                'user_id' => $lastInsertedID,
                                'competency_id' => $v,
                                'skill_value' => $_POST['competency-' . $v][0],
                            ));
//                            echo $this->db->last_query();
                        }
                    }
                }
            }
            redirect('admin/dashboard');
        }
        $this->data['subview'] = 'admin/user/edit';
        $this->data['job_title'] = $this->job_title_m->get_job_titles();
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function deleteUserComp($id) {
        $this->user_has_comp_m->deleteUserComp($id);
    }

    public function delete($id) {

        $this->user_m->delete($id);
        $this->deleteUserComp($id);
        redirect('admin/dashboard');
    }

    public function order_competency($id = null) {

        $this->data['skills'] = $this->skills_m->skillArray();
        $this->data['selectedArray'] = $this->user_m->getUserCompetencies($id);
        $this->data['compArray'] = $this->competency_m->getParentChild();
        $this->load->view('admin/user/order_competency', $this->data);
    }

}
