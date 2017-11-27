<?php

Class Job_title_has_comp_m extends My_Model {

    protected $_table_name = 'job_title_has_comp';
    protected $_order_by = '';
    public $rules = array();

    public function __construct() {
        parent::__construct();
    }

    public function deleteJobComp($id) {
        if (!$id) {
            return FALSE;
        }
        $this->db->where('job_title_id', $id);
        $this->db->delete($this->_table_name);
    }

}
