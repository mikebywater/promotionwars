<?php

namespace Database\Seeders;

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
        \DB::table('users')->insert([
            'name'     => 'Demo User',
            'email'    => 'demo@demo.com',
            'password' => \Hash::make('secret'),
        ]);
        \DB::table('users')->insert([
            'name'     => 'Mike Bywater',
            'email'    => 'mike.j.bywater@gmail.com',
            'password' => \Hash::make('secret'),
        ]);
    }
}
