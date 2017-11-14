<?php

class competency extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('competency_m');
    }

    function index() {
        $this->data['competencies'] = $this->competency_m->get_with_parent();
        //Load view
        $this->data['subview'] = 'admin/competency/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function modal() {
        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['competency'] = $this->competency_m->get($id);
            if (empty(count($this->data['competency'])))
                $this->data['errors'][] = "Competency could not be found";
        }
        else {
            $this->data['competency'] = $this->competency_m->get_new();
        }
        // competency for drop down menu
        $this->data['competency_without_parents'] = $this->competency_m->get_no_parents($id);
        $rules = $this->competency_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->competency_m->array_from_post(array('name', 'parent_id'));
            $this->competency_m->save($data, $id);
            redirect('admin/competency');
        }
        $this->data['subview'] = 'admin/competency/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->competency_m->delete($id);
        redirect('admin/competency');
    }

    public function order() {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/competency/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax() {
        // save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->competency_m->save_order($_POST['sortable']);
        }

        $this->data['competencies'] = $this->competency_m->get_nested();
        $this->load->view('admin/competency/order_ajax', $this->data);
    }

}
