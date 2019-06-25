<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'username' => 'misaka',
        	'password' => bcrypt('12345678'),
            'type' => 'admin'
        ]);
        DB::table('users')->insert([
            'username' => 'student',
            'password' => bcrypt('12345678'),
            'type' => 'student'
        ]);
        DB::table('users')->insert([
            'username' => 'teacher',
            'password' => bcrypt('12345678'),
            'type' => 'teacher'
        ]);
    }
}
