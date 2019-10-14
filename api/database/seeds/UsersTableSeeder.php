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
            'user_name' => 'patara',
            'pass_word' => Hash::make('1150kfc'),
            'created' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'user_name' => 'testuser',
            'pass_word' => Hash::make('testuser'),
            'created' => \Carbon\Carbon::now(),
        ]);
    }
}
