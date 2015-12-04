<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'firstname' => 'John Mark',
                'lastname' => 'Ssebunya',
                'email' => 'ssebunj@mtn.co.ug',
                'username' => 'ssebunj',
                'password' => Hash::make('admin')
            ),
            array(
                'firstname' => 'Patrick',
                'lastname' => 'Oryono',
                'email' => 'oryonop@mtn.co.ug',
                'username' => 'oryonop',
                'password' => Hash::make('admin')
            ),
            array(
                'firstname' => 'Abdul',
                'lastname' => 'Ssebagala',
                'email' => 'ssebaga@mtn.co.ug',
                'username' => 'ssebaga',
                'password' => Hash::make('admin')
            )
        );

        foreach($users as $user){
            \App\User::create($user);
        }
    }
}