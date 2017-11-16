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

    function index() {
        $this->data['users'] = $this->user_m->get_users();
        $this->data['userCompArray'] = $this->user_m->getUserCompArray();
        $this->data['jobsCompArray'] = $this->job_title_m->getJobsCompArray();
        $this->data['compArray'] = $this->competency_m->getSubCompArray();
        $commaList = '"'.implode('","', $this->data['compArray']).'"';
        echo $commaList;
        $this->data['skillArray'] = $this->skills_m->skillArray();
        //Load view
        $this->data['subview'] = 'admin/chart/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function getCompetency() {
//        echo json_encode('all is well');
        $userCompArray = $this->user_m->getUserCompArray();
        $jobsCompArray = $this->job_title_m->getJobsCompArray();
        $compArray = $this->competency_m->getSubCompArray();
        $commaList = '"'.implode('","', $compArray).'"';
//        $comma_separated = "'".$commaList."'";

        $skillArray = $this->skills_m->skillArray();

        echo json_encode(htmlspecialchars($commaList));
    }

}
