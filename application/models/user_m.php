<?php

Class user_m extends My_Model {

    protected $_table_name = 'users';
    protected $_order_by = '';
    public $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'),
    );
    public $rules_admin = array(
        'fname' => array(
            'field' => 'fname',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'lname' => array(
            'field' => 'lname',
            'label' => 'Email',
            'rules' => 'trim|required|xss_clean'
        ),
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_newUser() {
        $users = new stdClass();
        $users->fname = '';
        $users->lname = '';
        $users->job_title = '';
        $users->dob = date('d.y.Y');
        $users->ausbildung = '';
        $users->address = '';
        return $users;
    }

}
