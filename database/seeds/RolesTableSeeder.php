<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => "admin",
            'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => "member",
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => "Admin Bing",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        

       
    }
}
