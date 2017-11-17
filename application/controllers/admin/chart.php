<?php

class chart extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
        $this->load->model('job_title_m');
        $this->load->model('competency_m');
        $this->load->model('skills_m');
    }

    function index($id = null) {

        $this->data['users'] = $this->user_m->get_users();
        $this->data['competency_labels'] = json_encode($this->competency_m->getLabels());
        $this->data['userCompArray'] = json_encode($this->user_m->getAllUserCompArray());
        $this->data['jobsCompArray'] = json_encode($this->user_m->getUserJobCompetencies());

        //Load view
        $this->data['subview'] = 'admin/chart/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function getCompetency($id = null) {

        $this->data['competency_labels'] = $this->competency_m->getLabels();
        $this->data['userCompArray'] = $this->user_m->getUserCompArray($id);
        $this->data['jobsCompArray'] = $this->user_m->getUserJobCompetencies($id);
        echo json_encode($this->data);
    }

}
