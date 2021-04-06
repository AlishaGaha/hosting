<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'hint' => 'Can access every panel in admin.',
                'status' => 1
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'hint' => 'Can access limited panel in admin',
                'status' => 1
            ]
        ];

        foreach ($data as $row) {
            \App\Role::create($row);
        }
    }
}
