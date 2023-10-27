<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstname = "Admin";
        $lastname = "Admin";
        $middlename = "A";
        $username  = "admin";
        $password = "password";
        $usertype_id  = 1;

        User::create([
            "firstname" => $firstname,
            "lastname" => $lastname,
            "middlename" => $middlename,
            "username" => $username,
            "password" => Hash::make($password),
            "usertype_id" => $usertype_id,
        ]);
    }
}
