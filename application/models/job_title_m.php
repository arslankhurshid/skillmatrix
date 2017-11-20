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

    public function getJobTitleCompetencies($id = null) {
        $this->db->select('job_title.*, t3.name as competency_name, t3.id as competency_id,t2.skill_value, t3.parent_id,t4.name as parent_competency_name');
        $this->db->join('job_title_has_comp as t2', 't2.job_title_id = job_title.id', 'left');
        $this->db->join('competency as t3', 't3.id = t2.competency_id', 'left');
        $this->db->join('competency as t4', 't4.id = t3.parent_id', 'left');
        $this->db->where('job_title.id=', $id);

        $results = $this->db->get($this->_table_name)->result_array();
//        echo $this->db->last_query();

        $array = array();
        foreach ($results as $res) {
            $array[$res['competency_id']] = $res['skill_value'];
        }

        return $array;
    }

    public function getJobsCompArray($id) {
        $query = $this->db->query("SELECT * FROM job_title_has_comp WHERE job_title_has_comp.job_title_id = '".$id."' order by job_title_has_comp.competency_id ASC;");

        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['skill_value'];
        }
        return $response;
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

    public function get_newTitle() {
        $job_title = new stdClass();
        $job_title->title = '';

        return $job_title;
    }

    public function get_job_titles() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, title');
        $job_titles = $this->db->get($this->_table_name)->result_array();
        $array = array(0 => 'Keine');
        if (count($job_titles)) {
            foreach ($job_titles as $job_title) {
                $array[$job_title['id']] = $job_title['title'];
            }
        }
        return $array;
    }

}
