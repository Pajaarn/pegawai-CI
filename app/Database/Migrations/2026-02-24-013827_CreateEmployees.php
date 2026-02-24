<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'department_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'position_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nip'           => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'gender'        => ['type' => 'ENUM', 'constraint' => ['Laki-laki', 'Perempuan']],
            'phone'         => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'address'       => ['type' => 'TEXT', 'null' => true],
            'photo'         => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'salary'        => ['type' => 'INT', 'constraint' => 11],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'departments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('position_id', 'positions', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
