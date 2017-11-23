<?php

class login extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    // curd method
    public function index() {
        
    }

    public function login() {
        // Redirect the user if already login 
        $dashboard = 'admin/login/login';
        $this->user_m->loggedin() == FALSE || redirect($dashboard);
        //set form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);
        // process form
        if ($this->form_validation->run() == TRUE) {
//            $this->user_m->login();
            if ($this->user_m->login() == TRUE) {
                $this->session->set_flashdata('success', "login successfully..!!");
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('errors', "Sie müssen einen gültigen Usernamen und ein gültiges Passwort angeben.");
                redirect('admin/login/login');
            }
        }
        //load view
        $this->data['subview'] = 'admin/login/login';
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function logout() {
        $this->user_m->logout();
        redirect('admin/login/login');
    }

}
