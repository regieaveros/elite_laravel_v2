<?php

namespace Database\Seeders;

use App\Models\Usertype;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usertype = "System Admin";
        $restriction = '["dashboard","crews","users","documents","usertypes","ranks"]';

        Usertype::create([
            "usertype" => $usertype,
            "restriction" => $restriction,
        ]);
    }
}
