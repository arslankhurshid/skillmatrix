<?php

Class skills_m extends My_Model {

    protected $_table_name = 'skills';
    protected $_order_by = '';
    public $rules = array();
    public $rules_admin = array();

    public function __construct() {
        parent::__construct();
    }
    
    public function skillArray()
    {
        $this->db->select('id, name');
        $skills = parent::get();
        $array = array(0 => 'Keine');
        if (count($skills)) {
            foreach ($skills as $skill) {
                $array[$skill->id] = $skill->name;
            }
        }
        return $array;
    }

}
