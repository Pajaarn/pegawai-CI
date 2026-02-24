<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT), // HASIL HASH
                'role'     => 'admin',
            ],
            [
                'name'     => 'Pegawai Satu',
                'email'    => 'pegawai@gmail.com',
                'password' => password_hash('pegawai123', PASSWORD_DEFAULT), // HASIL HASH
                'role'     => 'pegawai',
            ]
        ];
        $this->db->table('users')->insertBatch($users);

        $departments = [
            ['department_name' => 'IT Support'],
            ['department_name' => 'Human Resources'],
        ];
        $this->db->table('departments')->insertBatch($departments);

        $positions = [
            ['position_name' => 'Manager'],
            ['position_name' => 'Staff'],
        ];
        $this->db->table('positions')->insertBatch($positions);
    }
}
