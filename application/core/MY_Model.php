<?php

Class My_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = Null, $single = FALSE) {
        if ($id != Null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_table_name . '.' . $this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }
        if (!count($this->db->order_by($this->_order_by))) {
            $this->db->order_by($this->_order_by);
        }
//        $this->db->select('*');
//        $this->db->from($this->_table_name);
//        $this->db->get();
////        
//        print_r($this->db->last_query());
//        exit();
//        $this->db->where('code', 'B');

        $query = $this->db->get($this->_table_name)->$method();

        return $query;
    }

    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data, $id = Null) {

        //set timestamps
        if ($this->_timestamps === TRUE) {
            $now = date('Y-m-d H:i:s');
            if ($id) {
                $data['modified'] = $now;
            } else {
                $data['created'] = $now;
                $data['modified'] = $now;
            }
        }
        // insert
        if ($id === Null) {
//            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = Null;
            $this->db->set($data);
            $this->db->insert($this->_table_name, $data);
            $lastinserted_id = $this->db->insert_id();
            print_r($this->db->error());
            echo $this->db->last_query();
            return $this->db->insert_id();
        }
        //update
        else {
            echo $id;
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
            echo $this->db->last_query();
            echo "<br>";
        }
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {

            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    public function get_total() {
        return $this->db->count_all($this->_table_name);
    }

}
