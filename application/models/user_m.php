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
    public $rules = array(
        'user_name' => array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'user_hash' => array(
            'field' => 'user_hash',
            'label' => 'Password',
            'rules' => 'trim|required'),
    );

    public function __construct() {
        parent::__construct();
    }

    public function getUserCompetencies($id = null) {
        $this->db->select('users.*, t3.name as competency_name, t3.id as competency_id, t2.skill_value, t3.parent_id, t4.name as parent_competency_name');
        $this->db->join('user_has_comp as t2', 't2.user_id = users.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->join('competency as t4', 't4.id = t3.parent_id', 'left');
        $this->db->where('users.id=', $id);

        $results = $this->db->get('users')->result_array();
//        echo $this->db->last_query();
        $array = array();
        foreach ($results as $res) {
            $array[$res['competency_id']] = $res['skill_value'];
        }

        return $array;
    }

    // get user competencies for Diagram against user_id
    public function getUserCompArray($id = null) {

        $query = $this->db->query("SELECT user_has_comp.skill_value FROM user_has_comp
							LEFT JOIN competency 
							on user_has_comp.competency_id = competency.id
							WHERE user_has_comp.user_id = '" . $id . "' order by competency.id ASC;
						");
        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['skill_value'];
        }
        return $response;
    }

    // get all users competencies against job_title

    public function listUserCompArray($id = null) {
        // get all users competencies against job_title
        $this->db->select('users.*, t2.skill_value');
        $this->db->join('user_has_comp as t2', 't2.user_id = users.id', 'left');
        $this->db->join('job_title as t3', 'users.job_title_id = t3.id', 'left');
        if ($id != 0) {
            $this->db->where('t3.id=', $id);
        }
        $result = $this->db->get('users')->result_array();
//        echo $this->db->last_query();
        $response = array();
        foreach ($result as $key => $val) {
            $response[$val['fname'] . ' ' . $val['lname']][] = $val['skill_value'];
        }
        return $response;
    }

    // get all user competencies for diagram
    public function getAllUserCompArray($id = null) {

        $query = $this->db->query("SELECT user_has_comp.skill_value FROM user_has_comp
							LEFT JOIN competency 
							on user_has_comp.competency_id = competency.id
							order by competency.id ASC;
						");
        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['skill_value'];
        }
        return $response;
    }

    public function getUserJobCompetencies($id = null) {
        $query = $this->db->query("SELECT t1.id,t1.job_title_id,t3.skill_value,t3.competency_id FROM users as t1
                                                        LEFT JOIN job_title as t2 ON t2.id = t1.job_title_id
                                                        LEFT JOIN job_title_has_comp as t3 on t3.job_title_id = t2.id
                                                        WHERE t1.id = '" . $id . "' order by t3.competency_id ASC;
                                                        ");

        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['skill_value'];
        }
        return $response;
    }

    public function get_user_view_details($perpage = null, $limit = null) {
        $this->db->select('users.*, t2.title as user_title');
        $this->db->join('job_title  as t2', 't2.id = users.job_title_id', 'left');
        $this->db->order_by("id", "desc");
        $this->db->limit($perpage, $limit);
        $results = parent::get();
//        $results = $this->db->get('users')->result_array();
        return $results;
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
        $this->db->select('users.*, fname, lname,t2.title');
        $this->db->join('job_title  as t2', 't2.id = users.job_title_id', 'left');
        $users = parent::get();
//        echo $this->db->last_query();
        $array = array('0' => 'Select');
        if (count($users)) {
            foreach ($users as $user) {
                $array[$user->title][$user->id] = $user->fname . " " . $user->lname;
            }
        }

        return $array;
    }

    public function login() {
        $user = $this->get_by(array(
            'user_name' => $this->input->post('user_name'),
            'user_hash' => $this->hash($this->input->post('user_hash'))
                ), TRUE);
        if (count($user)) {
            $data = array(
                'name' => $user->fname,
                'user_name' => $user->user_name,
                'id' => $user->id,
                'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
            return TRUE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
    }

    public function loggedin() {
//        echo "<pre>" . print_r($_SESSION);
//        echo "</pre>";
        return (bool) $this->session->userdata('loggedin');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
