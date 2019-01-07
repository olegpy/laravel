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
        DB::statement('SET foreign_key_checks=0');
        DB::table('users')->truncate();
        DB::statement('SET foreign_key_checks=1');

        $users = [
            [
                'name' => 'admin',
                'email' => 'olegkriklivets@gmail.com',
                'password' => bcrypt('admin'),
                'is_admin' => true,
            ],
            [
                'name' => 'test user',
                'email' => 'oleg_88@ukr.net',
                'is_admin' => false,
                'password' => bcrypt('test')
            ],
        ];

        \App\Models\User::insert($users);
    }
}
