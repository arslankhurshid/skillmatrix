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
        $this->data['titles'] = $this->job_title_m->get_job_titles();
        $this->data['competency_labels'] = json_encode($this->competency_m->getLabels());
        $this->data['userCompArray'] = json_encode($this->user_m->getAllUserCompArray());
        $this->data['jobsCompArray'] = json_encode($this->job_title_m->getJobsCompArray($id));
        $this->data['listUser'] = $this->user_m->listUserCompArray($id);

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

    function viewUsersChart($id = null) {
        $this->data['competency_labels'] = $this->competency_m->getLabels();
        $this->data['listUser'] = $this->user_m->listUserCompArray($id);
        $this->data['jobsCompArray'] = $this->job_title_m->getJobsCompArray($id);

        foreach ($this->data['listUser'] as $key => $val) {
            $datasets[] = [
                'label' => $key,
                'borderColor' => "#00FF00",
                'borderWidth' => 0.1,
                'data' => $val,
            ];
        }

        $secondaryDatset[] = array(
            'label' => "Soll",
            'borderColor' => "rgba(200,0,0,0.6)",
            'borderWidth' => 2,
            'data' => $this->data['jobsCompArray']
        );

        $datasets = array_merge($secondaryDatset, $datasets);

        echo json_encode($datasets);
    }

}
