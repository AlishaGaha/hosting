<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@admin.com',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $row = \DB::table('users')->where('email', 'root@admin.com')->first();

        \DB::table('user_details')->insert([
            'user_id' => $row->id,
            'first_name' => 'Root',
            'last_name' => 'User',
            'gender' => 'Male',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $role = Role::where('slug', 'super-admin')->first();
        $role->users()->sync([$row->id]);
    }
}
