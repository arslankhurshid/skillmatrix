<?php

class Migration_create_job_title extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('job_title');
    }

    public function down() {
        $this->dbforge->drop_table('job_title');
    }

}
