<?php

Class competency_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'competency';
    protected $_order_by = '';
    public $rules = array(
        'parent_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent',
            'rules' => 'trim|intval'
        ),
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
    );

    public function get_new() {
        $competency = new stdClass();
        $competency->name = '';
        $competency->parent_id = 0;
        return $competency;
    }

    public function delete($id) {
        //delete a competency
        parent::delete($id);
        //Reset parent id for its children
        $this->db->set('parent_id', 0); //value that used to update column  
        $this->db->where('parent_id', $id); //which row want to upgrade  
        $this->db->update($this->_table_name);  //table name
    }

    public function get_nested() {
        $this->db->order_by("order", "asc");
        $competencies = $this->db->get('competency')->result_array();
        $array = array();
        foreach ($competencies as $competency) {
            if (!$competency['parent_id']) {
                $array[$competency['id']] = $competency;
            } else {
                $array[$competency['parent_id']]['children'][] = $competency;
            }
        }
        return $array;
    }

    public function save_order($competencies) {
        if (count($competencies)) {
            foreach ($competencies as $order => $competency) {
                if ($competency['item_id'] !== '') {
                    $data = array('parent_id' => (int) $competency['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $competency['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_with_parent($id = NULL, $single = Null) {
        $this->db->select('competency.*, p.name as parent_name');
        $this->db->join('competency as p', 'competency.parent_id = p.id', 'left');
//        $test = parent::get($id, $single);
//        echo $this->db->last_query();

        return parent::get($id, $single);
    }

    public function getSubCompArray($id) {
        // get sub competency against parent competency in array for drop down
        $this->db->select('id, name');
        $this->db->where('parent_id=', $id);

        $categories = parent::get();

        $array = array();
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->name;
            }
        }
        return $array;
    }

    public function getParentChild($id=null) {
        $this->db->select('id, name, parent_id');
        $competencies = $this->db->get('competency')->result_array();
        $array = array();
        foreach ($competencies as $key => $competency) {

            if (!$competency['parent_id']) {
                $array[$competency['id']] = $competency;
            } else {
                $array[$competency['parent_id']]['child'][$competency['id']] = $competency['name'];
            }
        }
        return $array;
    }

    public function get_no_parents($id = null) {
        // Fetch all competencys w/out parents
        // Return key => value pair array
        $this->db->select('id, name');
        $this->db->where('parent_id', 0);
        $this->db->where('id!=', $id);

        $competencies = parent::get();
//        echo $this->db->last_query();

        $array = array(0 => 'Keine');

        if (count($competencies)) {
            foreach ($competencies as $competency) {
                $array[$competency->id] = $competency->name;
                if ($id != null) {
                    $parents = $this->get_with_parent();
                    $parentID = array();
                    foreach ($parents as $parent) {
                        $parentID[$parent->parent_id] = $parent->parent_name;
                        if ($parent->parent_id == $id) {
                            unset($array[$competency->id]);
                        }
                    }
                }
            }
        }


        return $array;
    }

}
