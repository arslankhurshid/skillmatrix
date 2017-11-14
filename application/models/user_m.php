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

    public function get_user_competencies($id = null, $single = null) {
        $this->db->select('users.*, t3.name as competency_name');
        $this->db->join('user_has_comp as t2', 't2.user_id = users.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->order_by("id", "desc");
        $results = $this->db->get('users')->result_array();
        $array = array();
        $finalArray = array();
        foreach ($results as $page) {
            $array[$page['id']][] = $page['competency_name'];
        }
        foreach ($array as $key => $arr) {
            $data[$key]['competency_name'] = implode(',', $arr);
        }

        foreach ($results as $result) {
            $anotherArray[$result['id']] = array(
                'id' => $result['id'],
                'fname' => $result['fname'],
                'lname' => $result['lname'],
                'job_title' => $result['job_title'],
                'dob' => $result['dob'],
                'address' => $result['address'],
                'ausbildung' => $result['ausbildung'],
            );
        }
        $res = array();
        foreach ($data as $k => $v) {
            $res[$k] = array_merge($data[$k], $anotherArray[$k]);
        }

        return $res;
//        echo $this->db->last_query();
//        return parent::get($id, $single);
    }

    public function get_newUser() {
        $users = new stdClass();
        $users->fname = '';
        $users->lname = '';
        $users->job_title = '';
        $users->dob = date('d.y.Y');
        $users->ausbildung = '';
        $users->address = '';
        $users->parent_id = 0;
        return $users;
    }

    public function get_users() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, fname, lname');
        $users = parent::get();
        $array = array(0 => 'Alle');
        if (count($users)) {
            foreach ($users as $user) {
                $array[$user->id] = $user->fname . " " . $user->lname;
            }
        }
        return $array;
    }

}
