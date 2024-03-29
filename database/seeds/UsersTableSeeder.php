<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $data = new User;
        $data->name = 'Admin';
        $data->username = 'admin';
        $data->email = 'admin@gmail.com';
        $data->role = 'Admin';
        $data->password = Hash::make('password');
        $data->save();
    }
}
