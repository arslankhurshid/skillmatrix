<?php

Class job_title_m extends My_Model {

    protected $_table_name = 'job_title';
    protected $_order_by = '';
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_job_title_competencies($id = null, $single = null) {
        $this->db->select('job_title.*, t3.name as competency_name, t4.name as parent_competency_name');
        $this->db->join('job_title_has_comp as t2', 't2.job_title_id = job_title.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->join('competency as t4', 't4.id = t3.parent_id', 'left');
        $this->db->order_by("id", "desc");

        $results = $this->db->get('job_title')->result_array();
//        echo "<pre>";
//        print_r($results);
//        echo "</pre>";
//        echo $this->db->last_query();
//        exit();
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
                'title' => $result['title'],
                'parent_competency_name' => $result['parent_competency_name'],
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
        $job_title = new stdClass();
        $job_title->title = '';
        $job_title->parent_id = 0;
        return $job_title;
    }

    public function get_job_titles() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, name');
        $job_titles = parent::get();
        $array = array(0 => 'Alle');
        if (count($job_titles)) {
            foreach ($job_titles as $job_title) {
                $array[$job_title->id] = $job_title->fname . " " . $job_title->lname;
            }
        }
        return $array;
    }

}
