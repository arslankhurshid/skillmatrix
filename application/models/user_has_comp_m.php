<?php

Class user_has_comp_m extends My_Model {

    protected $_table_name = 'user_has_comp';
    protected $_order_by = '';
    public $rules = array();
    public $rules_admin = array();

    public function __construct() {
        parent::__construct();
    }

}
