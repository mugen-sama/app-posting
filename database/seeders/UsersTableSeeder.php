<?php

namespace Database\Seeders;

use App\Models\User;
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
        //
        \App\Models\User::create([
            'name' => 'Sulton Daud Ul Mukarobin',
            'username' => 'mugenkun',
            'password' => bcrypt('password'),
            'email' => 'sulton.mukarobin@gmail.com',

        ]);
        // [
        //     'name' => 'Eko Setyanto',
        //     'username' => 'ekoinsite',
        //     'password' => bcrypt('password'),
        //     'email' => 'eko.setyanto@gmail.com',

        // ],
        // );
        // $users = [
        //     [
        //         'name' => 'Sulton Daud Ul Mukarobin',
        //         'username' => 'mugenkun',
        //         'password' => bcrypt('password'),
        //         'email' => 'sulton.mukarobin@gmail.com',
        
        //     ],
        //     [
        //         'name' => 'Eko Setyanto',
        //         'username' => 'ekoinsite',
        //         'password' => bcrypt('password'),
        //         'email' => 'eko.setyanto@gmail.com',
        //     ],
        // ];
        // \DB::table('users')->insert($users);
    }
}
