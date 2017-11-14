<?php

class chart extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
    }

    function index() {
        $this->data['users'] = $this->user_m->get_users();
        //Load view
        $this->data['subview'] = 'admin/chart/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

}
