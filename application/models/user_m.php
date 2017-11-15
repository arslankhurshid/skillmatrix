<?php

Class user_m extends My_Model {

    protected $_table_name = 'users';
    protected $_order_by = '';
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

    public function getUserCompetencies($id) {
        $this->db->select('users.*, t3.name as competency_name, t3.id as competency_id, t2.skill_value, t3.parent_id, t4.name as parent_competency_name');
        $this->db->join('user_has_comp as t2', 't2.user_id = users.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->join('competency as t4', 't4.id = t3.parent_id', 'left');
        $this->db->where('users.id=', $id);

        $results = $this->db->get('users')->result_array();

        $array = array();
        foreach ($results as $res) {
            $array[$res['competency_id']] = $res['skill_value'];
        }

        return $array;
    }

    public function get_user_competencies($id = null, $single = null) {
        $this->db->select('users.*, t3.name as competency_name, t4.name as parent_competency_name');
        $this->db->join('user_has_comp as t2', 't2.user_id = users.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->join('competency as t4', 't4.id = t3.parent_id', 'left');
        $this->db->order_by("id", "desc");
        $results = $this->db->get('users')->result_array();
//        echo $this->db->last_query();
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
                'job_title_id' => $result['job_title_id'],
                'dob' => $result['dob'],
                'address' => $result['address'],
                'ausbildung' => $result['ausbildung'],
                'parent_competency_name' => $result['parent_competency_name'],
            );
        }
        $res = array();
        foreach ($data as $k => $v) {
            $res[$k] = array_merge($data[$k], $anotherArray[$k]);
        }
//        echo "<pre>";
//        print_r($results);
//        echo "</pre>";

        return $res;

//        return parent::get($id, $single);
    }

    public function get_newUser() {
        $users = new stdClass();
        $users->fname = '';
        $users->lname = '';
        $users->dob = date('d.y.Y');
        $users->ausbildung = '';
        $users->address = '';
        $users->job_title_id = 0;
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
