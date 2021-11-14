<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->admin()->create();

        User::factory(5)->auditor()->create();

        User::factory(5)->creator()->create();


        User::factory(5)->deleter()->create();

    }
}
