<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->delete();

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'password' => Hash::make('qawsed53'),
            'email' => 'superadmin@gmail.com',
            'utype' => 'ADM',
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Admin',
            'password' => Hash::make('qawsed53'),
            'email' => 'amit@gmail.com',
            'utype' => 'USR',
            'created_at' => now(),
        ]);
    }
}
