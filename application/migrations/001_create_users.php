<?php

class Migration_create_users extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'fname' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
            'lname' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
            'dob' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'ausbildung' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }

}
