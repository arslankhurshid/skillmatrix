<?php

class dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_m');
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
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->user_m->delete($id);
        redirect('admin/user');
    }

}
