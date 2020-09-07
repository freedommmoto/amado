<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'patara@test.com',
            'enable' => true,
            'password' => app('hash')->make('1150kfc'),
        ]);

        DB::table('users')->insert([
            'email' => 'test@test.com',
            'enable' => true,
            'password' => app('hash')->make('asdasd'),
        ]);
    }
}
