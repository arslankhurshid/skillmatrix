<?php

class Migration_create_user_has_comp extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'competency_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'skill_value' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('user_has_comp');
    }

    public function down() {
        $this->dbforge->drop_table('user_has_comp');
    }

}
